<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    //
    public function anime_info($id)
    {
        // Anime Information Data
        $info_response = Http::get("https://api.jikan.moe/v4/anime/{$id}/full");
        $animeInfo = $info_response->json();
        $animeData = $animeInfo['data'] ?? [];
        
        $mal_id = $animeData['mal_id'] ?? 'Unknown';
        $title = $animeData['title'] ?? 'Unknown';
        $thumbnail = $animeData['images']['jpg']['image_url'] ?? '';
        $score = isset($animeData['score']) ? number_format($animeData['score'], 2) : 'N/A';
        $premiered = isset($animeData['season'], $animeData['year']) ? ucfirst("{$animeData['season']} {$animeData['year']}") : 'Unknown';
        $type = $animeData['type'] ?? 'Unknown';
        $episodes = $animeData['episodes'] ?? 'Unknown';
        $status = $animeData['status'] ?? 'Unknown';
        $aired = $animeData['aired']['string'] ?? 'Unknown';
        $broadcast = $animeData['broadcast']['string'] ?? 'Unknown';
        $source = $animeData['source'] ?? 'Unknown';
        $duration = $animeData['duration'] ?? 'Unknown';
        $rating = $animeData['rating'] ?? 'Unknown';
        $synopsis = $animeData['synopsis'] ?? 'No synopsis available';
        $songs = $animeData['theme'] ?? 'Unknown';
        $trailer = $animeData['trailer']['youtube_id'] ?? 'Unknown';

        // Convert Array Into String Format
        $studios = !empty($animeData['studios']) ? implode(', ', array_column($animeData['studios'], 'name')) : 'Unknown';
        $producers = !empty($animeData['producers']) ? implode(', ', array_column($animeData['producers'], 'name')) : 'Unknown';
        $licensors = !empty($animeData['licensors']) ? implode(', ', array_column($animeData['licensors'], 'name')) : 'Unknown';
        $genres = !empty($animeData['genres']) ? implode(', ', array_column($animeData['genres'], 'name')) : 'Unknown';
        $themes = !empty($animeData['themes']) ? implode(', ', array_column($animeData['themes'], 'name')) : 'Unknown';
        $demographics = !empty($animeData['demographics']) ? implode(', ', array_column($animeData['demographics'], 'name')) : 'Unknown';


        // Characters Data
        $characters_response = Http::get("https://api.jikan.moe/v4/anime/{$id}/characters");
        $charactersInfo = $characters_response->json();
        $charactersData = $charactersInfo['data'] ?? [];
        // Sort characters order by favorites
        array_multisort(array_column($charactersData, 'favorites'), SORT_DESC, $charactersData);


        // Staff Data
        $staff_response = Http::get("https://api.jikan.moe/v4/anime/{$id}/staff");
        $staffInfo = $staff_response->json();
        $staffData = $staffInfo['data'] ?? [];

        //dd($charactersData);
        return view('anime-info', [
            'title' => 'Anime Information',
            'mal_id' => $mal_id,
            'animeTitle' => $title,
            'thumbnail' => $thumbnail,
            'score' => $score,
            'premiered' => $premiered,
            'type' => $type,
            'episodes' => $episodes,
            'status' => $status,
            'aired' => $aired,
            'broadcast' => $broadcast,
            'source' => $source,
            'duration' => $duration,
            'rating' => $rating,
            'synopsis' => $synopsis,
            'studios' => $studios,
            'producers' => $producers,
            'licensors' => $licensors,
            'genres' => $genres,
            'themes' => $themes,
            'demographics' => $demographics,
            'charactersData' => $charactersData,
            'staffData' => $staffData,
            'songs' => $songs,
            'trailer' => $trailer
        ]);

    }
}
