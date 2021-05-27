@extends('layouts.main')

@section('title-page')
All Tags
@endsection

@section('content')
<h1>All tags</h1>

<div class="container">
   <ul>
@foreach ($tags as $tag)
  <li>{{ $tag->name }} </li>
@endforeach
   </ul>
</div>
    
@endsection