@extends('layouts.base')

@section('pageTitle')
    Modifica post
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
    <a href="{{ route('admin.posts.index')}}">Home Page</a>
    
    <form action="{{ route('admin.posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group" >
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $post->title }}">
        </div>

        <div class="form-group" >
            <label for="date">Data</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="{{ $post->date }}">
        </div>

        <div class="form-group" >
            <label for="content">Contenuto</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="content">{{ $post->content }}</textarea>
        </div>

        <div class="form-group" >
            <label for="image">Immagine</label>
            <img src="{{$post->image ? asset('storage/' . $post->image)  : asset('storage/images/150.png') }}" alt="{{$post->title}}" style="width: 100px; margin-bottom: 5px">
            <input type="file" class="d-block" id="image" name="image">
        </div>


        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="published" name="published" {{$post->published ? 'checked' : ''}}>
            <label class="form-check-label" for="published">Published</label>
        </div>
        @foreach ($tags as $tag)
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="{{ $tag->name }}" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $tag->name }}">
              {{ $tag->name }}
            </label>
        </div>
        @endforeach

        <div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </div>
        
    </form>
@endsection