@extends('layouts.app')

@section('content')

	<a href="/classes/incluir" class="btn btn-primary btn-adicionar">Adicionar</a>

	<table class="table table-striped table-bordered table-hover">
		<thead >
			<tr>
	            <th>Nome</th>
	        </tr>
        </thead>

        @if(empty($classes)) 
			<tr>
				<td>Nenhum registro encontrado!</td>
			</tr>
		@else 
			@foreach($classes as $classe)

			<tr>
				<td>{{$classe->nome}}</td>
				<td width="100px">
					<a href="/classes/{{$classe->id}}/alterar" class="btn btn-success">Alterar</a>
				</td>
				<td width="100px">
					<form action="/classes/{{$classe->id}}" method="post">
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

