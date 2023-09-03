<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_name',
        'section',
        'alumni_specialization',
        'class_year',
        'profile_id',
        'uploaded_at'


    ];
    public $timestamps = false;
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
