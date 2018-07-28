@extends('layouts.app')

@section('content')

	<form action="/classes/armazenar" method="post">
		@csrf

		<div class="form-group">

			<label>Nome</label>
			<input type="text" name="nome" class="form-control">

			<hr>
			<button class="btn btn-primary">Salvar</button>
			<a href="/classes" class="btn btn-danger">Cancelar</a>
			
		</div>
	</form>

@endsection