<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'events',
        'events_description',
        'status',
        'events_uploaded',
        'events_started',
        'events_end',
        'events_images',
        'profile_id',
    ];
    public $timestamps = false;
    public function profile()
    {
        return $this->belongsTo(profile::class);
    }
}





