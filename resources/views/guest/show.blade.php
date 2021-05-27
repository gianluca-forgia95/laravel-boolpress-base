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
					<h5>{{$comment->name ? $comment->name : 'Anonimo'}}</h5>
					<p>{{$comment->content}}</p>
				</li>
			@endforeach
		</ul>
	</div>
	@endif

	@if ($post->tags->isNotEmpty())
	<h3>Tags</h3>
	 @foreach ($post->tags as $tag)
	  <span class="badge badge-primary">{{$tag->name}}</span>
	 @endforeach	
	@endif

	{{-- Message Insert Guest --}}
	<h3>Add Comment</h3>
	<form action="{{ route('guest.posts.add-comment' , ['post' => $post->id ] )}}" method="POST">
	  @csrf
	  @method('POST')
	  <div class="form-group">
		<label for="title">Nome</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="Nome">
	  </div>
	  <div class="form-group">
		<label for="content">Commento</label>
		<textarea class="form-control"  name="content" id="content" cols="30" rows="5" placeholder="Commenta..."></textarea>
	  </div>
	 <div class="mt-3">
		<button type="submit" class="btn btn-primary">Add Comment</button>
	 </div>

	</form>

	{{-- /Message Insert Guest --}}
</div>
    
@endsection