@extends('layouts.main')

@section('title-page')
	{{$post->title}}
@endsection

@section('content')
<div class="container">
    <h2><strong>Titolo: </strong> {{ $post->title }}</h2>
	<p><strong>data:</strong> {{ $post->date }}</p>
	<p><strong>stato:</strong> {{ $post->published ? 'pubblicato' : 'non pubblicato' }}</p>
	<div><strong>tags: </strong>
		@foreach ($post->tags as $tag)
			<span class="badge badge-primary">{{$tag->name}}</span>
		@endforeach
	</div>
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
					<form action="{{route('admin.comments.destroy', [ 'comment' => $comment->id ])}}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger mb-10"><i class="fas fa-ban"></i></button>
					</form>
				</li>
			@endforeach
		</ul>
	</div>
	@endif
	<a href="{{route('admin.posts.index')}}">Torna alla lista degli articoli</a>
</div>

@endsection