@extends('layouts.app')

@section('content')

	<?php function isAlteracao() { return Request::is('*/alterar');} ?>

	<form action="{{isAlteracao() ? '/especialidades/' . $especialidade->id : '/especialidades/armazenar'}}" method="post">

		@csrf
		@if(isAlteracao()) 
			@method('PUT')
		@endif
		
		<div class="form-group">
			<label>Nome</label>
			<input type="text" name="nome" class="form-control" maxlength="50" value="{{count($errors) > 0 ? old('nome') : (isAlteracao() ? $especialidade->nome : '')}}">

			<hr>
			<button class="btn btn-primary">Salvar</button>
			<a href="/especialidades" class="btn btn-danger">Cancelar</a>
		</div>

	</form>

@endsection