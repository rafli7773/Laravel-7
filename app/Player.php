<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['user_id', 'team_id', 'thumbnail', 'name', 'slug', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->thumbnail;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
