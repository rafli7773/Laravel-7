<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        $tags = $tag->latest()->paginate(6);
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|unique:tags,name|min:3'
        ]);
        $attr = request()->all();
        $attr['slug'] = Str::slug(request()->name);
        auth()->user()->tags()->create($attr);
        request()->session()->flash('berhasil', 'Berhasil di simpan');
        return redirect()->to('/tags');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $players = $tag->players()->latest()->paginate(6);
        return view('tags.show', compact('players', 'tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag)
    {
        $this->validate(request(), [
            'name' => 'required|min:3'
        ]);
        $attr = request()->all();
        $attr['slug'] = Str::slug(request()->name);
        $tag->update($attr);
        request()->session()->flash('berhasil', 'Berhasil di edit');
        return redirect()->to('/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        request()->session()->flash('berhasil', 'Berhasil di hapus');
        return redirect()->to('/tags');
    }
}
