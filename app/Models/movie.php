<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'time_duration',
        'description',
        'category',
        'link_yt',
        'premiere_date',
        'view_movie',
        'image',
        'stars',
       
    ];
}
