@extends('layouts.app')

@section('content')

	<form action="/especialidades/{{$especialidade->id}}" method="post">

		@csrf
		{{method_field('PUT')}}

		<div>

			<label>Nome</label>
			<input type="text" name="nome" class="form-control" value="{{$especialidade->nome}}">

			<hr>
			<button class="btn btn-primary">Salvar</button>
			<a href="/especialidades" class="btn btn-danger">Cancelar</a>
		</div>
	</form>

@endsection