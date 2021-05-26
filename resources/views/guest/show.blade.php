
@extends('layouts.guest')

@section('pageTitle')
	{{$post->title}}
@endsection

@section('content')
<div class="mt-3">
	<h1>{{$post->title}}</h1>
	<h4>{{$post->date}}</h4>
	<p>{{$post->content}}</p>
	<div>
        <strong>tags: </strong>
		@foreach ($post->tags as $tag)
			<span class="badge badge-primary">{{$tag->name}}</span>
		@endforeach
	</div> 

	@if ($post->comments->isNotEmpty())
	<div class="mt-5">
		<h3>Commenti</h3>
		<ul>
			@foreach ($post->comments as $comment)
				<li>
					<h5>{{$comment->name}}</h5>
					<p>{{$comment->content}}</p>
				</li>
			@endforeach
		</ul>
	</div>
	@endif
</div>
@endsection
