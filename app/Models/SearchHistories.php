<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistories extends Model
{
    //
    protected $fillable = [
        'user_id',
        'search_query',
        'genre_filter',
        'minscore_filter',
        'maxscore_filter',
        'type_filter',
        'rating_filter',
        'year_filter',
    ];
}
