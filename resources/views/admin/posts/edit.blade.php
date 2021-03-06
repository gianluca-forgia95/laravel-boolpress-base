@extends('layouts.main')

@section('title-page')
Edit {{ $post->title }}
@endsection


@section('content')


  <div class="container mt-10">
    <h1>Edit Article</h1>
    <form action="{{ route('admin.posts.update', [ 'post' => $post->id ])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date" value="{{ $post->date }}">
        </div>
        <div class="form-group">
          <label for="img">Img Post</label>
          <img src="{{asset('storage/' . $post->img)}}" width="100">
          <input type="file" id="img" name="img">
      </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" placeholder="Enter Content" rows="15">{{ $post->content }}</textarea>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="published" name="published" {{  $post->published ? 'checked' : '' }}>
          <label class="form-check-label" for="published">Published</label>
        </div>
    
        <div class="mt-5">
          <h3>Tags</h3>
          @foreach ($tags as $tag)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->name}}" name="tags[]" {{ $post->tags->contains($tag) ? 'checked' : ''}}>
              <label class="form-check-label" for="{{$tag->name}}">
                {{$tag->name}}
              </label>
            </div>
          @endforeach
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>  
@endsection