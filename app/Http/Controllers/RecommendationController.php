<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class RecommendationController extends Controller
{
    public function homepage(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view recommendations.');
        }

        $user = Auth::user();

        // Decode the user's anime list
        $animeList = is_string($user->anime_list) ? json_decode($user->anime_list, true) : ($user->anime_list ?? []);

        // Log the user's anime list
        Log::info('User  anime list', ['anime_list' => $animeList]);

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

        Log::info('Collected anime IDs for recommendations', [
            'liked' => $likedAnimeIds,
            'currently_watching' => $currentlyWatchingAnimeIds,
            'plan_to_watch' => $planToWatchAnimeIds,
        ]);

        $recommendations = [];

        foreach (array_merge($likedAnimeIds, $currentlyWatchingAnimeIds, $planToWatchAnimeIds) as $malId) {
            // Generate the raw Jikan API URL
            $apiUrl = "https://api.jikan.moe/v4/anime/{$malId}/recommendations";
            Log::info('Generated API URL', ['url' => $apiUrl]);

            $response = Http::get($apiUrl);
            $data = $response->json();

            Log::info('Fetching recommendations for mal_id', ['mal_id' => $malId, 'response' => $data]);

            if (isset($data['data']) && !empty($data['data'])) {
                foreach ($data['data'] as $recommendation) {
                    Log::info('Processing recommendation', ['recommendation' => $recommendation]);

                    if (isset($recommendation['entry']['mal_id'])) {
                        $recommendations[] = [
                            'mal_id' => $recommendation['entry']['mal_id'],
                            'title' => $recommendation['entry']['title'] ?? 'Unknown Title',
                            'images' => [
                                'jpg' => [
                                    'image_url' => $recommendation['entry']['images']['jpg']['image_url'] ?? 'default_thumbnail.jpg',
                                ],
                            ],
                        ];
                    } else {
                        Log::warning('Missing mal_id in recommendation', ['recommendation' => $recommendation]);
                    }
                }
            } else {
                Log::warning('No recommendations found for mal_id', ['mal_id' => $malId]);
            }
        }

        shuffle($recommendations);
        
        $currentPage = $request->input('page', 1);
        $perPage = 25; // Number of recommendations per page
        $offset = ($currentPage - 1) * $perPage;
        $paginatedRecommendations = new LengthAwarePaginator(
            array_slice($recommendations, $offset, $perPage),
            count($recommendations),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        if ($paginatedRecommendations->isEmpty()) {
            Log::error('Recommendations array is empty after processing', ['recommendations' => $recommendations]);
        }

        Log::info('Final recommendations array', ['recommendations' => $paginatedRecommendations]);

        //dd($apiUrl);
        return view('welcome', [
            'title' => 'Welcome to AniMap',
            'data' => [
                'data' => $paginatedRecommendations,
            ],
            'currentPage' => $currentPage,
            'lastPage' => $paginatedRecommendations->lastPage(),
        ]);
    }
}
