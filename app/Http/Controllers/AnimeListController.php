<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AnimeListController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your anime list.');
        }

        $user = Auth::user();

        $animeList = is_string($user->anime_list) ? json_decode($user->anime_list, true) : ($user->anime_list ?? []);

        $animeData = [];
        foreach ($animeList as $anime) {
            if (isset($anime['mal_id'])) {
                $animeInfoResponse = Http::get("https://api.jikan.moe/v4/anime/{$anime['mal_id']}");
                $animeInfo = $animeInfoResponse->json();

                $statusMapping = [
                    'liked' => 'Liked',
                    'plan_to_watch' => 'Plan to Watch',
                    'currently_watching' => 'Currently Watching',
                    'disliked' => 'Disliked',
                    'wont_watch' => "Won't Watch"
                ];
                $status = $statusMapping[$anime['status']] ?? 'Unknown';

                $animeData[] = [
                    'mal_id' => $anime['mal_id'],
                    'title' => $animeInfo['data']['title'] ?? 'Unknown',
                    'score' => $animeInfo['data']['score'] ?? 'N/A',
                    'premiered' => isset($animeInfo['data']['season'], $animeInfo['data']['year']) ? ucfirst("{$animeInfo['data']['season']} {$animeInfo['data']['year']}") : 'Unknown',
                    'type' => $animeInfo['data']['type'] ?? 'Unknown',
                    'studios' => !empty($animeInfo['data']['studios']) ? implode(', ', array_column($animeInfo['data']['studios'], 'name')) : 'Unknown',
                    'status' => $status,
                    'thumbnail' => $animeInfo['data']['images']['jpg']['image_url'] ?? 'default_thumbnail.jpg'
                ];
            } else {
                Log::warning('Missing mal_id in anime list', ['anime' => $anime]);
            }
        }

        return view('anime-list', [
            'title' => 'My Anime List',
            'animeData' => $animeData,
        ]);
    }
}
