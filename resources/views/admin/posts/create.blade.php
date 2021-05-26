@extends('layouts.main')

@section('title-page')
Create A Post
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

<div class="container mt-5">
<h1>Create a Post</h1>

<form action="{{ route('admin.posts.store')}}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title" value="{{ old('title') }}">
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date" value="{{ old('date') }}">
    </div>
    <div class="form-group">
        <label for="img">Img Post</label>
        <input type="text" class="form-control" id="img" name="img"  placeholder="Enter Url Img" value="{{ old('img') }}">
      </div>
    <div class="form-group">
        <label for="content">Content</label> 
        <textarea class="form-control" id="content" name="content" placeholder="Enter Content" rows="15">{{ old('caption')}}</textarea>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="published" name="published">
      <label class="form-check-label" for="published">Published</label>
    </div>

    <div class="mt-5">
      <h3>Tags</h3>
      @foreach ($tags as $tag)
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->name}}" name="tags[]">
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