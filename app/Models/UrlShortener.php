<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'shorten_url',
        'original_url',
        'click_count',
    ];
}
