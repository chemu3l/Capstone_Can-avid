<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'Action',
        'Type',
        'Old_data',
        'New_data',
        'profile_id',
        'Date'
    ];
    public $timestamps = false;
    public function profile()
    {
        return $this->belongsTo(profile::class);
    }
}
