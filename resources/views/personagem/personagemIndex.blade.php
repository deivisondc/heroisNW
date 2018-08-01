@extends('layouts.app')

@section('content')

	<a href="/personagens/incluir" class="btn btn-primary btn-adicionar">Adicionar</a>

	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<td>Nome</td>
				<td>Classe</td>
				<td>Especialidades</td>
			</tr>
		</thead>

		@if(empty($personagens)) 
			<tr>
				<td colspan="3">Nenhum registro encontrado!</td>
			</tr>
		@else 
			@foreach($personagens as $personagem)

			<tr>
				<td>{{$personagem->nome}}</td>
				<td>{{$personagem->classe->nome}}</td>
				<td width="250px">{{$personagem->nomeDasEspecialidades()}}</td>
				<td width="100px" class="td-thumb">
					<img src="{{!empty($personagem->thumbmail) && Storage::disk('public')->exists($personagem->thumbmail) ? '/storage/' . $personagem->thumbmail : '/storage/avatar_silhouette.png' }}" class="img-thumb">
				</td>
				<td width="100px">
					<a href="/personagens/{{$personagem->id}}" class="btn btn-info">Detalhes</a>
				</td>
				<td width="100px">
					<a href="/personagens/{{$personagem->id}}/alterar" class="btn btn-success">Alterar</a>
				</td>
				<td width="100px">
					<form action="/personagens/{{$personagem->id}}" method="post">
						
						@csrf
						@method('DELETE')

						<button class="btn btn-danger">Remover</button>

					</form>
				</td>
			</tr>

			@endforeach
		@endif
	</table>

@endsection