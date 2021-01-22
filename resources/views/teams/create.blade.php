@extends('layouts.app')

@section('title', 'Buat Team')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Buat Tim
                </div>
                <div class="card-body">
                    <form action="/teams/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" autofocus value="{{old('name')}}">
                            @error('name')
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