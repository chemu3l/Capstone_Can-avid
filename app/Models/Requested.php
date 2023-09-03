<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requested extends Model
{
    use HasFactory;
    protected $fillable = [
        'requested_document',
        'student_name',
        'requester_name',
        'date_to_get',
        'requester_email'
    ];
}
