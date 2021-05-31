@extends('layouts.base')

@section('pageTitle')
    Crea un nuovo post
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> 
        </div>
    @endif
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group" >
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" >
        </div>

        <div class="form-group" >
            <label for="date">Data</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Date" >
        </div>

        <div class="form-group" >
            <label for="content">Contenuto</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="content"></textarea>
        </div>

        <div class="form-group" >
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>


        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="published" name="published">
            <label class="form-check-label" for="published">Published</label>
        </div>

        @foreach ($tags as $tag)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->name }}">
            <label class="form-check-label" for="{{ $tag->name }}">
              {{ $tag->name }}
            </label>
        </div>
        @endforeach

        <div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </div>
        
    </form>
@endsection