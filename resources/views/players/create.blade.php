@extends('layouts.app')

@section('title', 'Buat Player')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Buat Player
                </div>
                <div class="card-body">
                    <form action="/players/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" autofocus
                                value="{{old('name')}}">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="team_id">
                                <option selected disabled>Pilih Team</option>
                                @foreach ($teams as $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach ($tags as $tag)
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tags</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{$tag->name}}" name="tag[]" value="{{$tag->id}}">
                                <label class="form-check-label" for="{{$tag->name}}">{{$tag->name}}</label>
                            </div>
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description"
                                rows="3">{{old('description')}}</textarea>
                                @error('description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Gambar</label>
                            <input name="thumbnail" class="form-control" type="file" id="formFile">
                            @error('thumbnail')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection