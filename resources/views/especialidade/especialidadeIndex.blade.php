@extends('layouts.app')

@section('content')

	<a href="especialidades/incluir" class="btn btn-primary btn-adicionar">Adicionar</a>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>Nome</td>
			</tr>
		</thead>
		@foreach($especialidades as $especialidade)

		<tr>
			<td>{{$especialidade->nome}}</td>
			<td width="100px">
				<a href="/especialidades/{{$especialidade->id}}/alterar" class="btn btn-success">Alterar</a>
			</td>
			<td width="100px">
				<form action="/especialidades/{{$especialidade->id}}" method="post">
					@csrf
					{{method_field('DELETE')}}

					<button class="btn btn-danger">Remover</button>
				</form>
			</td>
		</tr>

		@endforeach
	</table>

@endsection