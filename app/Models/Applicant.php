<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_name',
        'applicant_email',
        'career_id',
        'date_applied',
        'applicant_resume',
    ];
    public $timestamps = false;

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
