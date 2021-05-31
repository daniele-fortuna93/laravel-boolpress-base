<h1>Nuovo Commento</h1>
@if ( $comment->name != null)
<p>{{ $comment->name}} ha commentato il post: {{ $post->title }}</p>
@else
<p>Hai un nuovo commento sul post: {{ $post->title }}</p>
    
@endif