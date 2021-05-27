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
  <a href="{{route('admin.tags.edit', [ 'tag' => $tag->id ])}}"><button type="button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a>
  <form action="{{route('admin.tags.destroy', [ 'tag' => $tag->id ])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
</form>
@endforeach
   </ul>
   @if (session('message'))
    <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
        {{ session('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
    </div>
</div>
@endif
</div>
    
@endsection