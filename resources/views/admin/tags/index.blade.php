@extends('layouts.main')

@section('title-page')
All Tags
@endsection

@section('content')

<div class="container">
    <h1>All tags</h1>
<a href="{{route('admin.tags.create')}}"><button type="button" class="btn btn-success"><i class="fas fa-plus-square"></i> Aggiungi Tag</button></a>
   <ul>
@foreach ($tags as $tag)
  <li>{{ $tag->name }} </li>
@endforeach
   </ul>
</div>
    
@endsection