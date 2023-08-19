<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'news',
        'news_description',
        'news_updated',
        'news_uploaded',
        'news_images',
        'personnel added',
    ];

}
