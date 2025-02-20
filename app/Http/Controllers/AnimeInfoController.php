<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AnimeInfos;

class AnimeInfoController extends Controller
{
    public function anime_info($id)
    {
        $animeInfo = AnimeInfos::where('mal_id', $id)->first();
        $animeData = $this->fetchAnimeData($id);
        $charactersData = $this->fetchCharactersData($id);
        $staffData = $this->fetchStaffData($id);

        if ($animeInfo) {
            return view('anime-info', $this->prepareViewDataFromDatabase($animeInfo));
        } else {
            $this->insertAnimeInfo($animeData, $charactersData, $staffData);

            return view('anime-info', $this->prepareViewData($animeData, $charactersData, $staffData));
        }
    }

    private function fetchAnimeData($id)
    {
        $response = Http::get("https://api.jikan.moe/v4/anime/{$id}/full");
        return $response->json()['data'] ?? [];
    }

    private function fetchCharactersData($id)
    {
        $response = Http::get("https://api.jikan.moe/v4/anime/{$id}/characters");
        $charactersData = $response->json()['data'] ?? [];

        array_multisort(array_column($charactersData, 'favorites'), SORT_DESC, $charactersData);

        foreach ($charactersData as &$char) {
            usort($char['voice_actors'], function ($a, $b) {
                return ($b['language'] === 'Japanese') - ($a['language'] === 'Japanese');
            });
        }

        return $charactersData;
    }

    private function fetchStaffData($id)
    {
        $response = Http::get("https://api.jikan.moe/v4/anime/{$id}/staff");
        return $response->json()['data'] ?? [];
    }

    private function prepareViewData($animeData, $charactersData, $staffData)
    {
        return [
            'title' => 'Anime Information',
            'mal_id' => $animeData['mal_id'] ?? 'Unknown',
            'animeTitle' => $animeData['title'] ?? 'Unknown',
            'thumbnail' => $animeData['images']['jpg']['image_url'] ?? '',
            'score' => isset($animeData['score']) ? number_format($animeData['score'], 2) : 'N/A',
            'premiered' => isset($animeData['season'], $animeData['year']) ? ucfirst("{$animeData['season']} {$animeData['year']}") : 'Unknown',
            'type' => $animeData['type'] ?? 'Unknown',
            'episodes' => $animeData['episodes'] ?? 'Unknown',
            'status' => $animeData['status'] ?? 'Unknown',
            'aired' => $animeData['aired']['string'] ?? 'Unknown',
            'broadcast' => $animeData['broadcast']['string'] ?? 'Unknown',
            'source' => $animeData['source'] ?? 'Unknown',
            'duration' => $animeData['duration'] ?? 'Unknown',
            'rating' => $animeData['rating'] ?? 'Unknown',
            'synopsis' => $animeData['synopsis'] ?? 'No synopsis available',
            'studios' => $this->convertArrayToString($animeData['studios'] ?? []),
            'producers' => $this->convertArrayToString($animeData['producers'] ?? []),
            'licensors' => $this->convertArrayToString($animeData['licensors'] ?? []),
            'genres' => $this->convertArrayToString($animeData['genres'] ?? []),
            'themes' => $this->convertArrayToString($animeData['themes'] ?? []),
            'demographics' => $this->convertArrayToString($animeData['demographics'] ?? []),
            'charactersData' => $charactersData,
            'staffData' => $staffData,
            'songs' => $animeData['theme'] ?? 'Unknown',
            'trailer' => $animeData['trailer']['youtube_id'] ?? 'Unknown',
        ];
    }

    private function prepareViewDataFromDatabase($animeInfo)
    {
        return [
            'title' => 'Anime Information',
            'mal_id' => $animeInfo->mal_id,
            'animeTitle' => $animeInfo->anime_title,
            'thumbnail' => $animeInfo->thumbnail,
            'score' => $animeInfo->score,
            'premiered' => $animeInfo->premiered,
            'type' => $animeInfo->type,
            'episodes' => $animeInfo->episodes,
            'status' => $animeInfo->status,
            'aired' => $animeInfo->aired,
            'broadcast' => $animeInfo->broadcast,
            'source' => $animeInfo->source,
            'duration' => $animeInfo->duration,
            'rating' => $animeInfo->rating,
            'synopsis' => $animeInfo->synopsis,
            'studios' => $animeInfo->studios,
            'producers' => $animeInfo->producers,
            'licensors' => $animeInfo->licensors,
            'genres' => $animeInfo->genres,
            'themes' => $animeInfo->themes,
            'demographics' => $animeInfo->demographics,
            'charactersData' => json_decode($animeInfo->charactersData, true),
            'staffData' => json_decode($animeInfo->staffData, true),
            'songs' => json_decode($animeInfo->songs, true),
            'trailer' => $animeInfo->trailer,
        ];
    }

    private function insertAnimeInfo($animeData, $charactersData, $staffData)
    {
        $existingAnime = AnimeInfos::where('mal_id', $animeData['mal_id'])->first();

        if (!$existingAnime) {
            $songsData = [
                'openings' => $animeData['theme']['openings'] ?? [],
                'endings' => $animeData['theme']['endings'] ?? [],
            ];

            AnimeInfos::create([
                'mal_id' => $animeData['mal_id'],
                'anime_title' => $animeData['title'] ?? null,
                'thumbnail' => $animeData['images']['jpg']['image_url'] ?? null,
                'score' => $animeData['score'] ?? null,
                'premiered' => isset($animeData['season'], $animeData['year']) ? ucfirst("{$animeData['season']} {$animeData['year']}") : null,
                'type' => $animeData['type'] ?? null,
                'episodes' => $animeData['episodes'] ?? null,
                'status' => $animeData['status'] ?? null,
                'aired' => $animeData['aired']['string'] ?? null,
                'broadcast' => $animeData['broadcast']['string'] ?? null,
                'source' => $animeData['source'] ?? null,
                'duration' => $animeData['duration'] ?? null,
                'rating' => $animeData['rating'] ?? null,
                'synopsis' => $animeData['synopsis'] ?? null,
                'studios' => $this->convertArrayToString($animeData['studios'] ?? []),
                'producers' => $this->convertArrayToString($animeData['producers'] ?? []),
                'licensors' => $this->convertArrayToString($animeData['licensors'] ?? []),
                'genres' => $this->convertArrayToString($animeData['genres'] ?? []),
                'themes' => $this->convertArrayToString($animeData['themes'] ?? []),
                'demographics' => $this->convertArrayToString($animeData['demographics'] ?? []),
                'charactersData' => json_encode($charactersData),
                'staffData' => json_encode($staffData),
                'songs' => json_encode($songsData),
                'trailer' => $animeData['trailer']['youtube_id'] ?? null,
            ]);
        }
    }

    private function convertArrayToString($array)
    {
        return !empty($array) ? implode(', ', array_column($array, 'name')) : 'Unknown';
    }
}
