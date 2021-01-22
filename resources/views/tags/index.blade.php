@extends('layouts.app')

@section('title', 'Tags')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Daftar Tag</h1>
        </div>
        <div class="col-md-6">
            @if (Auth::check())
            <a href="/tags/create" class="btn btn-primary mb-2">Buat</a>
            @else
            <a href="/login" class="btn btn-primary mb-2">Login</a>
            @endif
        </div>
    </div>
    @if (session('berhasil'))
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('berhasil')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <div class="row d-flex justify-content-around text-center">
        @foreach ($tags as $tag)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card" style="width: 18rem;">
                @if ($tag->thumbnail)
                <img src="{{$tag->takeImage}}" class="card-img-top" alt="">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$tag->name}}</h5>
                    <div class="text-secondary">Di tulis oleh : {{$tag->user->name}}</div>
                    <div class="d-flex justify-content-around">
                        <a href="/tags/{{$tag->slug}}" class="btn btn-primary">List</a>
                        @can('delete', $tag)
                        <form action="/tags/{{$tag->slug}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('yakin')">Hapus</button>
                        </form>
                        @endcan
                        @can('update', $tag)
                        <a href="/tags/{{$tag->slug}}/edit" class="btn btn-success">Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection