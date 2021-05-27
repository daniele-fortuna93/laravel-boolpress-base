@extends('layouts.base')

@section('pageTitle')
	{{$post->title}}
@endsection

@section('content')
	<p><strong>data:</strong> {{$post->date}}</p>
	<p><strong>stato:</strong> {{$post->published ? 'pubblicato' : 'non pubblicato'}}</p>
    @if (count($post->tags) > 0)
    <div>
        <strong>tags: </strong>
		@foreach ($post->tags as $tag)
			<span class="badge badge-primary">{{$tag->name}}</span>
		@endforeach
	</div> 
    @endif
	
	<hr>
	<p>{{$post->content}}</p>
	
	@if ($post->comments->isNotEmpty())
	<div class="mt-5">
		<h3>Commenti</h3>
		<ul>
			@foreach ($post->comments as $comment)
				<li>
					<h5>{{$comment->name ? $comment->name : 'Anonimo'}}</h5>
					<p>{{$comment->content}}</p>

					<form action="{{ route('admin.posts.comment-delete', $comment->id)}}" method="post">
						@csrf
						@method('DELETE')
						<button type="submit">Elimina</button>
					</form>
				</li>
			@endforeach
		</ul>
	</div>
	@endif
	<a href="{{route('admin.posts.index')}}">Torna alla lista degli articoli</a>
@endsection