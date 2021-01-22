<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['user_id', 'name', 'slug', 'thumbnail'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->thumbnail;
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
