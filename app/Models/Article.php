<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'waktu_posting',
        'kategori_slug',
        'status',
        'thumbnail',
        'views',
        'excerpt',
        'author',
        'date',
        'category',
    ];

    protected $casts = [
        'waktu_posting' => 'datetime',
        'date' => 'date',
        'views' => 'integer',
    ];
}