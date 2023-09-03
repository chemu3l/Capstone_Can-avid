<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationalChart extends Model
{
    use HasFactory;
    protected $fillable = [
        'organizational_image',
        'profile_id',
        'uploaded_at'
    ];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
