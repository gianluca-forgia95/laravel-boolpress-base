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
  <a href="{{route('admin.tags.show', [ 'tag' => $tag->id ])}}"><button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></a>
	<a href="{{route('admin.tags.edit', [ 'tag' => $tag->id ])}}"><button type="button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a>
  <form action="{{route('admin.tags.destroy', [ 'tag' => $tag->id ])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
</form>
@endforeach
   </ul>


   <h3>Crea un nuovo tag</h3>
	<form action="{{route('admin.tags.store')}}" method="POST">
		@csrf
		@method('POST')
		<div class="form-group">
			<label for="name">Nome</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Nome">
		</div>
		<div class="mt-3">
			<button type="submit" class="btn btn-primary">Crea</button>
		</div>
	</form>	
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