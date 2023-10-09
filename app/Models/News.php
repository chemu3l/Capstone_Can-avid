<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'news',
        'news_description',
        'status',
        'news_updated',
        'news_uploaded',
        'news_images',
        'profile_id',
    ];
    public $timestamps = false;
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
