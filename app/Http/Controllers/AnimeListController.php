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
        if (!$this->isUserAuthenticated()) {
            return $this->redirectToLogin();
        }

        $user = Auth::user() instanceof User ? Auth::user() : null;
        $animeList = $this->getAnimeList($user);

        $animeData = $this->getAnimeData($animeList);

        return view('anime-list', [
            'title' => 'My Anime List',
            'animeData' => $animeData,
        ]);
    }

    private function isUserAuthenticated()
    {
        return Auth::check();
    }

    private function redirectToLogin()
    {
        return redirect()->route('login')->with('error', 'You must be logged in to view your anime list.');
    }

    private function getAnimeList(User $user)
    {
        return is_string($user->anime_list) ? json_decode($user->anime_list, true) : ($user->anime_list ?? []);
    }

    private function getAnimeData(array $animeList)
    {
        $animeData = [];

        foreach ($animeList as $anime) {
            if (isset($anime['mal_id'])) {
                $animeInfo = $this->getAnimeInfo($anime['mal_id']);
                $status = $this->getStatusLabel($anime['status']);

                $animeData[] = [
                    'mal_id' => $anime['mal_id'],
                    'title' => $animeInfo['title'] ?? 'Unknown',
                    'score' => $animeInfo['score'] ?? 'N/A',
                    'premiered' => $animeInfo['premiered'] ?? 'Unknown',
                    'type' => $animeInfo['type'] ?? 'Unknown',
                    'studios' => $animeInfo['studios'] ?? 'Unknown',
                    'status' => $status,
                    'thumbnail' => $animeInfo['thumbnail'] ?? 'default_thumbnail.jpg',
                ];
            } else {
                Log::warning('Missing mal_id in anime list', ['anime' => $anime]);
            }
        }

        return $animeData;
    }

    private function getAnimeInfo($mal_id)
    {
        $animeInfoResponse = Http::get("https://api.jikan.moe/v4/anime/{$mal_id}");
        $animeInfo = $animeInfoResponse->json();

        return [
            'title' => $animeInfo['data']['title'] ?? 'Unknown',
            'score' => $animeInfo['data']['score'] ?? 'N/A',
            'premiered' => isset($animeInfo['data']['season'], $animeInfo['data']['year'])
                            ? ucfirst("{$animeInfo['data']['season']} {$animeInfo['data']['year']}")
                            : 'Unknown',
            'type' => $animeInfo['data']['type'] ?? 'Unknown',
            'studios' => !empty($animeInfo['data']['studios'])
                        ? implode(', ', array_column($animeInfo['data']['studios'], 'name'))
                        : 'Unknown',
            'thumbnail' => $animeInfo['data']['images']['jpg']['image_url'] ?? 'default_thumbnail.jpg',
        ];
    }

    private function getStatusLabel($status)
    {
        $statusMapping = [
            'liked' => 'Liked',
            'plan_to_watch' => 'Plan to Watch',
            'currently_watching' => 'Currently Watching',
            'disliked' => 'Disliked',
            'wont_watch' => "Won't Watch"
        ];

        return $statusMapping[$status] ?? 'Unknown';
    }
}
