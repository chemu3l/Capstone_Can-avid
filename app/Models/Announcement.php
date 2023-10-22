<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'announcements',
        'announcements_what',
        'announcements_who',
        'announcements_when',
        'announcements_where',
        'announcements_why',
        'announcements_how',
        'profile_id',
        'announcements_images',
        'announcements_uploaded',
        'status'
    ];
    public $timestamps = false;
    public function profile()
    {
        return $this->belongsTo(profile::class);
    }
}
