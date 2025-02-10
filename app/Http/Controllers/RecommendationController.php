<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\SearchHistories;

class RecommendationController extends Controller
{
    public function homepage(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }

        $user = Auth::user();
        $latestSearch = $this->getLatestSearch($user->id);

        $queryInput = $latestSearch ? $latestSearch->search_query : null;
        $genreInput = $latestSearch ? $latestSearch->genre_filter : null;

        $animeList = $this->getUserAnimeList($user);
        [$likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds] = $this->categorizeAnimeList($animeList);

        Log::info('Collected anime IDs for recommendations', [
            'liked' => $likedAnimeIds,
            'currently_watching' => $currentlyWatchingAnimeIds,
            'plan_to_watch' => $planToWatchAnimeIds,
        ]);

        $recommendations = $this->fetchRecommendations($request, $queryInput, $genreInput, $likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds);

        if (empty($recommendations)) {
            Log::error('Recommendations array is empty after processing', ['recommendations' => $recommendations]);
        }

        return $this->paginateAndReturnView($request, $recommendations);
    }

    private function getLatestSearch($userId)
    {
        return SearchHistories::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    private function getUserAnimeList($user)
    {
        return is_string($user->anime_list) ? json_decode($user->anime_list, true) : ($user->anime_list ?? []);
    }

    private function categorizeAnimeList($animeList)
    {
        $likedAnimeIds = [];
        $currentlyWatchingAnimeIds = [];
        $planToWatchAnimeIds = [];

        foreach ($animeList as $anime) {
            if (isset($anime['mal_id'])) {
                switch ($anime['status']) {
                    case 'liked':
                        $likedAnimeIds[] = $anime['mal_id'];
                        break;
                    case 'currently_watching':
                        $currentlyWatchingAnimeIds[] = $anime['mal_id'];
                        break;
                    case 'plan_to_watch':
                        $planToWatchAnimeIds[] = $anime['mal_id'];
                        break;
                }
            } else {
                Log::warning('Missing mal_id in anime list', ['anime' => $anime]);
            }
        }

        return [$likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds];
    }

    private function fetchRecommendations($request, $queryInput, $genreInput, $likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds)
    {
        $recommendations = [];

        if ($queryInput) {
            $recommendations = array_merge($recommendations, $this->fetchFromJikan(['q' => $queryInput, 'page' => $request->input('page', 1)]));
        }

        if ($genreInput) {
            $recommendations = array_merge($recommendations, $this->fetchFromJikan(['genres' => $genreInput, 'page' => $request->input('page', 1)]));
        }

        foreach (array_merge($likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds) as $malId) {
            $recommendations = array_merge($recommendations, $this->fetchAnimeRecommendations($malId));
        }

        if (!empty($likedAnimeIds) || !empty($currentlyWatchingAnimeIds) || !empty($planToWatchAnimeIds)) {
            shuffle($recommendations);
        }

        return $recommendations;
    }

    private function fetchFromJikan($queryParams)
    {
        $apiUrl = "https://api.jikan.moe/v4/anime";
        $response = Http::get($apiUrl, $queryParams);
        $data = $response->json();
        return $this->processJikanResponse($data);
    }

    private function fetchAnimeRecommendations($malId)
    {
        $apiUrl = "https://api.jikan.moe/v4/anime/{$malId}/recommendations";
        $response = Http::get($apiUrl);
        $data = $response->json();
        return $this->processJikanResponse($data, true);
    }

    private function processJikanResponse($data, $isRecommendation = false)
    {
        $recommendations = [];
        if (isset($data['data']) && !empty($data['data'])) {
            foreach ($data['data'] as $recommendation) {
                $entry = $isRecommendation ? $recommendation['entry'] : $recommendation;
                if (isset($entry['mal_id'])) {
                    $recommendations[] = [
                        'mal_id' => $entry['mal_id'],
                        'title' => $entry['title'] ?? 'Unknown Title',
                        'images' => [
                            'jpg' => [
                                'image_url' => $entry['images']['jpg']['image_url'] ?? 'default_thumbnail.jpg',
                            ],
                        ],
                    ];
                } else {
                    Log::warning('Missing mal_id in recommendation', ['recommendation' => $recommendation]);
                }
            }
        } else {
            Log::warning('No recommendations found', ['response' => $data]);
        }

        return $recommendations;
    }

    private function paginateAndReturnView($request, $recommendations)
    {
        $currentPage = $request->input('page', 1);
        $perPage = 25;
        $offset = ($currentPage - 1) * $perPage;

        $paginatedRecommendations = new LengthAwarePaginator(
            array_slice($recommendations, $offset, $perPage),
            count($recommendations),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('welcome', [
            'title' => 'Welcome to AniMap',
            'data' => ['data' => $paginatedRecommendations],
            'currentPage' => $currentPage,
            'lastPage' => $paginatedRecommendations->lastPage(),
        ]);
    }
}
