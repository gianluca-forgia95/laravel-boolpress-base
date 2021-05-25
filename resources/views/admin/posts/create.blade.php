@extends('layouts.main')

@section('title-page')
Create A Post
@endsection


@section('content')

<div class="container mt-5">
<h1>Create a Post</h1>

<form action="{{ route('admin.posts.store')}}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title">
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="Enter Content" rows="15"></textarea>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="published" name="published">
      <label class="form-check-label" for="published">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
    
@endsection