@extends('layouts.app')

@section('content')

	<a href="/raids/incluir" class="btn btn-primary btn-adicionar">Adicionar</a>

	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Total</th>
			</tr>
		</thead>

		@if(empty($raids)) 
			<tr>
				<td colspan="2">Nenhum registro encontrado!</td>
			</tr>
		@else 
			@foreach($raids as $raid)
				<tr>
					<td>{{$raid->descricao}}</td>
					<td width="50px">{{count($raid->personagens)}}</td>
					<td width="100px">
						<a href="/raids/{{$raid->id}}" class="btn btn-info">Detalhes</a>
					</td>
					<td width="100px">
						<a href="/raids/{{$raid->id}}/alterar" class="btn btn-success">Alterar</a>
					</td>
					<td width="100px">
						<form action="/raids/{{$raid->id}}" method="post">
							
							@csrf
							{{method_field('DELETE')}}

							<button class="btn btn-danger">Remover</button>
						</form>
					</td>
				</tr>
			@endforeach
		@endif
	</table>

@endsection