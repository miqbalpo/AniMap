<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimeInfos extends Model
{
    //
    protected $fillable = [
        'mal_id',
        'anime_title',
        'thumbnail',
        'score',
        'premiered',
        'type',
        'episodes',
        'status',
        'aired',
        'broadcast',
        'source',
        'duration',
        'rating',
        'synopsis',
        'studios',
        'producers',
        'licensors',
        'genres',
        'themes',
        'demographics',
        'charactersData',
        'staffData',
        'songs',
        'trailer',
    ];
}
