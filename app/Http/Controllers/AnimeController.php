<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    //
    public function anime_info(){
        $response = Http::get("https://api.jikan.moe/v4/anime");
        $data = $response->json();
    }
}
