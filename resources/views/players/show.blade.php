@extends('layouts.app')

@section('title', 'Detail Player')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        @if ($player->team)
                        <div>Team : <a href="/teams/{{$player->team->slug}}">{{$player->team->name}}</a></div>
                        @else
                        <div>Team : <a href="/teams/create/">Belum terdaftar</a></div>
                        @endif
                        @if ($player->tags)
                        @foreach ($player->tags as $tag)
                        <a href="/tags/{{$tag->slug}}">#{{$tag->name}}</a>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$player->name}}</h5>
                    <p class="card-text">{{$player->description}}</p>
                    <div class="d-flex justify-content-between">
                        <a href="/players" class="btn btn-primary">Kembali</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Yakin Menghapus Data : {{$player->name}} ? </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @can('delete', $player)
                <form action="/players/{{$player->slug}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection