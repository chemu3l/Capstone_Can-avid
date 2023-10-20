<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{


    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = [
        'name',
        'age',
        'gender',
        'position',
        'department',
        'phone_number',
        'images',
        'user_id',
    ];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'foreign_key');
    }
    public function event()
    {
        return $this->hasMany(Event::class);
    }
    public function new()
    {
        return $this->hasMany(News::class);
    }
    public function announcement()
    {
        return $this->hasMany(Announcement::class);
    }
    public function career()
    {
        return $this->hasMany(Career::class);
    }

    public function organizational_chart()
    {
        return $this->hasMany(OrganizationalChart::class);
    }
    public function history()
    {
        return $this->hasMany(History::class);
    }
}
