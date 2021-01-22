@extends('layouts.app')

@section('title', 'Edit Team')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Tim
                </div>
                <div class="card-body">
                    <form action="/teams/{{$team->slug}}/edit" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" autofocus value="{{old('name') ?? $team->name}}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Gambar : {{$team->thumbnail}}</label>
                            <input name="thumbnail" class="form-control" type="file" id="formFile">
                            @error('thumbnail')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection