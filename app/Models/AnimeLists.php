<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimeLists extends Model
{
    //
    protected $fillable = [
        'user_id',
        'mal_id',
        'status',
    ];
}
