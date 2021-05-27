@extends('layouts.main')

@section('title-page')
Edit Tag
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
<h1>Edit Tag</h1>

<form action="{{ route('admin.tags.update' , [ 'tag' => $tag->id ])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Tag Name" value="{{ $tag->name }}">
    </div>
    

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
    
@endsection