<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function browse(Request $request)
    {
        $query = $request->query('anime_title', null);
        $genreInput = $request->query('genre', null);
        $scoreInput = $request->query('score', null);
        $minScore = $request->query('min_score', null);
        $maxScore = $request->query('max_score', null);
        $typeInput = $request->query('type', null);
        $ratingInput = $request->query('rating', null);
        $yearInput = $request->query('year', null);
        $page = $request->query('page', 1);
        $title = str_replace(' ', '-', strtolower($query));

        $genreListResponse = Http::get("https://api.jikan.moe/v4/genres/anime");
        $genreList = $genreListResponse->json()['data'];

        $genreMap = [];
        foreach ($genreList as $genre) {
            $genreMap[$genre['mal_id']] = $genre['name'];
        }

        $queryParams = ['page' => $page];

        if ($genreInput) {
            if (is_numeric($genreInput)) {
                $queryParams['genres'] = (int)$genreInput;
            } elseif (array_key_exists(strtolower($genreInput), array_map('strtolower', $genreMap))) {
                $genreId = array_search(strtolower($genreInput), array_map('strtolower', $genreMap));
                $queryParams['genres'] = $genreId;
            }
        }

        if ($scoreInput) {
            switch ($scoreInput) {
                case '10.0 - 8.00':
                    $minScore = 8.0;
                    $maxScore = 10.0;
                    break;
                case '7.99 - 6':
                    $minScore = 6.0;
                    $maxScore = 7.99;
                    break;
                case '5.99 - 3.00':
                    $minScore = 3.0;
                    $maxScore = 5.99;
                    break;
                case '< 2.99':
                    $minScore = null;
                    $maxScore = 2.99;
                    break;
            }
        }

        if (empty($title) && empty($genreInput) && ($minScore === null && $maxScore === null) && !$yearInput) {
            $apiUrl = "https://api.jikan.moe/v4/top/anime";
        } else {
            $apiUrl = "https://api.jikan.moe/v4/anime";

            if (!empty($title)) {
                $queryParams['q'] = $title;
            }
            if ($minScore !== null) {
                $queryParams['min_score'] = $minScore;
            }
            if ($maxScore !== null) {
                $queryParams['max_score'] = $maxScore;
                $queryParams['order_by'] = "rank";
            }
        }

        if ($typeInput) {
            $queryParams['type'] = $typeInput;
        }

        if ($ratingInput) {
            $queryParams['rating'] = $ratingInput;
        }

        if ($yearInput) {
            $startDate = "{$yearInput}-01-01";
            // $endDate = "{$yearInput}-12-31";
            $queryParams['start_date'] = $startDate;
            // $queryParams['end_date'] = $endDate;
            $queryParams['order_by'] = "start_date";
        }

        $queryParams['sfw'] = true;

        $response = Http::get($apiUrl, $queryParams);
        $data = $response->json();
        $finalApiUrl = $apiUrl . '?' . http_build_query($queryParams);
        //dd($finalApiUrl);

        $oldGenre = null;
        if ($genreInput && is_numeric($genreInput) && isset($genreMap[$genreInput])) {
            $oldGenre = $genreInput;
        } elseif ($genreInput && !is_numeric($genreInput)) {
            $oldGenre = array_search(strtolower($genreInput), array_map('strtolower', $genreMap));
        }

        $lastPage = isset($data['pagination']) ? $data['pagination']['last_visible_page'] : 1;

        return view('search-results', [
            'title' => 'Anime Search',
            'data' => $data,
            'genreList' => $genreList,
            'oldTitle' => $query,
            'oldGenre' => $oldGenre,
            'oldScore' => $scoreInput,
            'oldType' => $typeInput,
            'oldRating' => $ratingInput,
            'currentPage' => $page,
            'lastPage' => $lastPage,
            'minScore' => $minScore,
            'maxScore' => $maxScore,
            'oldYear' => $yearInput,
        ]);
    }
}
