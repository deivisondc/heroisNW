@extends('layouts.app')

@section('content')

	<form action="/classes/{{$classe->id}}" method="post">

		@csrf
		{{method_field('PUT')}}

		<div class="form-group">
			
			<label>Nome</label>
			<input type="text" name="nome" class="form-control" value="{{$classe->nome}}">

			<hr>
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="/classes" class="btn btn-danger">Cancelar</a>

		</div>
	</form>

@endsection