@extends('layouts.guest')

@section('title-page')
{{ $post->title }}
@endsection


@section('content')
<a href="{{ route('guest.posts.index')}}">Back to Homepage</a>
<div class="container mt-5">
	<h1>Title: {{$post->title}}</h1>
	<h4>Published in: {{$post->date}}</h4>
	<p>Content: {{$post->content}}</p>
    

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