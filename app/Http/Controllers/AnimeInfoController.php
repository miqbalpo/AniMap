<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimeInfoController extends Controller
{
    public function anime_info($id)
    {
        $animeData = $this->fetchAnimeData($id);
        $charactersData = $this->fetchCharactersData($id);
        $staffData = $this->fetchStaffData($id);

        return view('anime-info', $this->prepareViewData($animeData, $charactersData, $staffData));
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

    private function convertArrayToString($array)
    {
        return !empty($array) ? implode(', ', array_column($array, 'name')) : 'Unknown';
    }
}
