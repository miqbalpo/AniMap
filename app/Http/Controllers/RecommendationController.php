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

        // Log the raw API URLs directly before making the API calls
        if ($queryInput) {
            $queryUrl = "https://api.jikan.moe/v4/anime?" . http_build_query(['q' => $queryInput, 'page' => $request->input('page', 1), 'sfw' => 1]);
            Log::info('Raw API request URL for query input', ['url' => $queryUrl]);
        }

        if ($genreInput) {
            $genreUrl = "https://api.jikan.moe/v4/anime?" . http_build_query(['genres' => $genreInput, 'page' => $request->input('page', 1), 'sfw' => 1]);
            Log::info('Raw API request URL for genre input', ['url' => $genreUrl]);
        }

        foreach (array_merge($likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds) as $malId) {
            $recommendationUrl = "https://api.jikan.moe/v4/anime/{$malId}/recommendations?" . http_build_query(['sfw' => 1]);
            Log::info('Raw API request URL for anime recommendations', ['url' => $recommendationUrl]);
        }

        // Fetch recommendations based on the query and genres
        $recommendations = $this->fetchRecommendations($request, $queryInput, $genreInput, $likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds);

        if (empty($recommendations)) {
            Log::error('Recommendations array is empty after processing', ['recommendations' => $recommendations]);
        }

        //dd($recommendations);
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
            $queryRecommendations = $this->fetchFromJikan(['q' => $queryInput, 'page' => $request->input('page', 1), 'sfw' => 1]);
            $recommendations = array_merge($recommendations, $queryRecommendations);
        }

        if ($genreInput) {
            $genreRecommendations = $this->fetchFromJikan(['genres' => $genreInput, 'page' => $request->input('page', 1), 'sfw' => 1]);
            $recommendations = array_merge($recommendations, $genreRecommendations);
        }

        $allAnimeIds = array_merge($likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds);

        foreach ($allAnimeIds as $malId) {
            $animeRecommendations = $this->fetchAnimeRecommendations($malId, true);
            $recommendations = array_merge($recommendations, $animeRecommendations);
        }

        if (!empty($allAnimeIds)) {
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

    private function fetchAnimeRecommendations($malId, $isRecommendation = false)
    {
        $apiUrl = "https://api.jikan.moe/v4/anime/{$malId}/recommendations";
        $response = Http::get($apiUrl, ['sfw' => 1]);
        $data = $response->json();
        return $this->processJikanResponse($data, $isRecommendation);
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

