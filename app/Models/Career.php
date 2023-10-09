<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $fillable = [
        'career_position',
        'career_description',
        'career_uploaded',
        'career_requirements',
        'status',
        'profile_id'
    ];
    public $timestamps = false;
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function applicant()
    {
        return $this->hasMany(Applicant::class);
    }
}
