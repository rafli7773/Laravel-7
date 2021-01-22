<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['user_id', 'name', 'slug'];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
