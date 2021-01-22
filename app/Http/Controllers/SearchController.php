<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function player()
    {
        $query = request('query');
        $players = Player::where("name", "like", "%$query%")->latest()->paginate(6);
        return view('players.index', compact('players'));
    }
}
