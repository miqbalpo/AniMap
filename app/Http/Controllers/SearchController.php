<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SearchHistories;
use Illuminate\Support\Facades\Auth;

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

        $genreList = $this->getGenreList();
        $queryParams = $this->buildQueryParams($request, $genreInput, $scoreInput, $minScore, $maxScore, $typeInput, $ratingInput, $yearInput, $title, $page);

        $apiUrl = $this->determineApiUrl($title, $genreInput, $minScore, $maxScore, $yearInput);
        $response = Http::get($apiUrl, $queryParams);
        $data = $response->json();

        $oldGenre = $this->getOldGenre($genreInput, $genreList);
        $lastPage = isset($data['pagination']) ? $data['pagination']['last_visible_page'] : 1;

        $this->logSearchHistory($query, $genreInput, $minScore, $maxScore, $typeInput, $ratingInput, $yearInput);

        //dd($apiUrl, $queryParams);
        $searchResultsPage = view('search-results', [
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
        return $searchResultsPage;
    }

    private function getGenreList()
    {
        $genreListResponse = Http::get("https://api.jikan.moe/v4/genres/anime");
        return $genreListResponse->json()['data'];
    }

    private function buildQueryParams(Request $request, $genreInput, $scoreInput, &$minScore, &$maxScore, $typeInput, $ratingInput, $yearInput, $title, $page)
    {
        $queryParams = ['page' => $page];

        if ($genreInput) {
            $this->setGenreQueryParam($genreInput, $queryParams);
        }

        if ($scoreInput) {
            $this->setScoreQueryParams($scoreInput, $minScore, $maxScore);
        }

        if (!empty($title)) {
            $queryParams['q'] = $title;
        }
        if ($minScore !== null) {
            $queryParams['min_score'] = $minScore;
            $queryParams['order_by'] = "rank";
        }
        if ($maxScore !== null) {
            $queryParams['max_score'] = $maxScore;
            $queryParams['order_by'] = "rank";
        }
        if ($typeInput) {
            $queryParams['type'] = $typeInput;
        }
        if ($ratingInput) {
            $queryParams['rating'] = $ratingInput;
        }
        if ($yearInput) {
            $queryParams['start_date'] = "{$yearInput}-01-01";
            $queryParams['order_by'] = "start_date";
        }

        $queryParams['sfw'] = true;

        return $queryParams;
    }

    private function setGenreQueryParam($genreInput, &$queryParams)
    {
        $genreList = $this->getGenreList();
        $genreMap = [];
        foreach ($genreList as $genre) {
            $genreMap[$genre['mal_id']] = $genre['name'];
        }

        if (is_numeric($genreInput)) {
            $queryParams['genres'] = (int)$genreInput;
        } elseif (array_key_exists(strtolower($genreInput), array_map('strtolower', $genreMap))) {
            $genreId = array_search(strtolower($genreInput), array_map('strtolower', $genreMap));
            $queryParams['genres'] = $genreId;
        }
    }

    private function setScoreQueryParams($scoreInput, &$minScore, &$maxScore)
    {
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

    private function determineApiUrl($title, $genreInput, $minScore, $maxScore, $yearInput)
    {
        if (empty($title) && empty($genreInput) && ($minScore === null && $maxScore === null) && !$yearInput) {
            $apiUrl = "https://api.jikan.moe/v4/top/anime";
        } else {
            $apiUrl = "https://api.jikan.moe/v4/anime";
        }
        return $apiUrl;
    }

    private function getOldGenre($genreInput, $genreList)
    {
        $oldGenre = null;
        if ($genreInput && is_numeric($genreInput) && isset($genreList[$genreInput])) {
            $oldGenre = $genreInput;
        } elseif ($genreInput && !is_numeric($genreInput)) {
            $oldGenre = array_search(strtolower($genreInput), array_map('strtolower', $genreList));
        }
        return $oldGenre;
    }

    private function logSearchHistory($query, $genreInput, $minScore, $maxScore, $typeInput, $ratingInput, $yearInput)
    {
        if (Auth::id()) {
            SearchHistories::create([
                'user_id' => Auth::id(),
                'search_query' => $query,
                'genre_filter' => $genreInput,
                'minscore_filter' => $minScore,
                'maxscore_filter' => $maxScore,
                'type_filter' => $typeInput,
                'rating_filter' => $ratingInput,
                'year_filter' => $yearInput,
            ]);
        }
    }
}
