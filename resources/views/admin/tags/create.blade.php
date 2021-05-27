@extends('layouts.main')

@section('title-page')
Create A Tag
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
<h1>Create a Tag</h1>

<form action="{{ route('admin.tags.store')}}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Tag Name" value="{{ old('name') }}">
    </div>
    

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
    
@endsection