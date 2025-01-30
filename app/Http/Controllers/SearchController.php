<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    //
    public function browse(Request $request)
    {
        $query = $request->query('anime_title', null);
        $title= str_replace(' ', '-', strtolower($query));

        if($title == null){
            $response = Http::get("https://api.jikan.moe/v4/top/anime");
            $data = $response->json();
        } else {
            $response = Http::get("https://api.jikan.moe/v4/anime", ['q' => $title]);
            $data = $response->json();
        }

        return view('search-results', [
            'data' => $data,
            'title' => 'Anime Search'
        ]);
    }

}
