<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\AnimeInfos;
use App\Models\AnimeLists;

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

        $animeListPage = view('anime-list', [
            'title' => 'My Anime List',
            'animeData' => $animeData,
        ]);

        return $animeListPage;
    }

    private function isUserAuthenticated()
    {
        $isAuthenticated = Auth::check();
        return $isAuthenticated;
    }

    private function redirectToLogin()
    {
        return redirect()->route('login')->with('error', 'You must be logged in to view your anime list.');
    }

    private function getAnimeList(User $user)
    {
        $animeLists = AnimeLists::where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->toArray();
        return $animeLists;
    }

    private function getAnimeData(array $animeList)
    {
        $animeData = [];

        $statusMapping = [
            'liked' => 'Liked',
            'plan_to_watch' => 'Plan to Watch',
            'currently_watching' => 'Currently Watching',
            'disliked' => 'Disliked',
            'wont_watch' => "Won't Watch"
        ];

        $malIds = array_column($animeList, 'mal_id');
        $animeInfos = AnimeInfos::whereIn('mal_id', $malIds)
            ->get();

        $animeInfoMap = $animeInfos->keyBy('mal_id');

        foreach ($animeList as $anime) {
            if (isset($anime['mal_id'])) {
                if ($animeInfoMap->has($anime['mal_id'])) {
                    $animeInfo = $animeInfoMap->get($anime['mal_id']);

                    $status = $statusMapping[$anime['status']] ?? 'Unknown';

                    $animeData[] = [
                        'mal_id' => $animeInfo->mal_id,
                        'title' => $animeInfo->anime_title,
                        'score' => $animeInfo->score,
                        'premiered' => $animeInfo->premiered,
                        'type' => $animeInfo->type,
                        'studios' => $animeInfo->studios,
                        'status' => $status,
                        'thumbnail' => $animeInfo->thumbnail,
                    ];
                } else {
                    Log::warning('Anime info not found in database', ['mal_id' => $anime['mal_id']]);
                }
            } else {
                Log::warning('Missing mal_id in anime list', ['anime' => $anime]);
            }
        }

        return $animeData;
    }

}
