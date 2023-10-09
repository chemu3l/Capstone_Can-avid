<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'search_id',
        'Document',
        'Student_Name',
        'Requester_Name',
        'Date_to_Get',
        'Requester_Email',
        'Requested_At'
    ];
    public $timestamps = false;

}
