<?php

namespace App\Http\Controllers;

use App\Player;
use App\Tag;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index(Player $player)
    {
        $players = $player->latest()->paginate(6);
        return view('players.index', compact('players'));
    }

    public function show(Team $team, Player $player)
    {
        return view('players.show', compact('team', 'player'));
    }

    public function create(Team $team, Tag $tag)
    {
        $teams = $team->all();
        $tags = $tag->all();
        return view('players.create', compact('teams', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:players,name',
            'description' => 'required|min:3',
            'thumbnail' => 'image|max:2004|mimes:png,jpg, jpeg, svg, jfif'
        ]);
        $attr = $request->all();
        $attr['thumbnail'] = $request->file('thumbnail') ? $request->file('thumbnail')->store('images/players') : null;
        $attr['slug'] = Str::slug($request->name);
        $player = auth()->user()->players()->create($attr);
        $player->tags()->attach(request('tag'));
        $request->session()->flash('berhasil', 'Berhasil di simpan');
        return redirect()->to('/players');
    }

    public function edit(Player $player, Team $team, Tag $tag)
    {
        $teams = $team->all();
        $tags = $tag->all();
        return view('players.edit', compact('player', 'teams', 'tags'));
    }

    public function update(Player $player)
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'image' => 'image|max:2004|mimes:png,jpg,jpeg,svg,jfif'
        ]);
        $attr = request()->all();
        if (request()->file('thumbnail')) {
            $thumbnail = request()->file('thumbnail')->store('images/players');
            Storage::delete($player->thumbnail);
        } else {
            $thumbnail = $player->thumbnail;
        }

        $attr['thumbnail'] = $thumbnail;
        $attr['slug'] = Str::slug(request()->name);
        $player->update($attr);
        $player->tags()->sync(request('tag'));
        request()->session()->flash('berhasil', 'Berhasil di Edit');
        return redirect()->to('/players');
    }

    public function destroy(Player $player)
    {
        Storage::delete($player->thumbnail);
        $player->tags()->detach();
        $player->delete();
        request()->session()->flash('berhasil', 'Berhasil di Hapus');
        return redirect()->to('/players');
    }
}
