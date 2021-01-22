<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        $teams = $team->latest()->paginate(6);
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $teamRequest)
    {
        $attr = $teamRequest->all();
        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store('images/teams') : null;
        $attr['thumbnail'] = $thumbnail;
        $attr['slug'] = Str::slug(request()->name);
        auth()->user()->teams()->create($attr);
        request()->session()->flash('berhasil', 'Berhasil di simpan');
        return redirect()->to('/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $players = $team->players()->latest()->paginate(6);
        return view('teams.show', compact('players', 'team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $attr = $request->all();
        $this->validate($request, [
            'name' => 'required|min:3',
            'thumbnail' => 'imgae|mimes:png,jpg,svg,jfif,jpeg',
        ]);
        if (request()->file('thumbnail')) {
            $thumbnail = request()->file('thumbnail')->store('images/teams');
            Storage::delete($team->thumbnail);
        } else {
            $thumbnail = $team->thumbnail;
        }
        $attr['slug'] = Str::slug(request()->name);
        $attr['thumbnail'] = $thumbnail;
        $team->update($attr);
        request()->session()->flash('berhasil', 'Berhasil di edit');
        return redirect()->to('/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        request()->session()->flash('berhasil', 'Berhasil di hapus');
        return redirect()->to('/teams');
    }
}
