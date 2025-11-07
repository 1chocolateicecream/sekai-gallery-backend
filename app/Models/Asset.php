<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'image_url',
        'unit',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
