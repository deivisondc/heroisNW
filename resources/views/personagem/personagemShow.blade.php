@extends('layouts.app')

@section('content')

	<div class="form-group row">
		<label class="col-sm-1 col-form-label lbl-bold">Nome</label>
		<div class="col-sm-10">
			<label class="col-sm-10 col-form-label">{{$personagem->nome}}</label>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-1 col-form-label lbl-bold">Classe</label>
		<div class="col-sm-10">
			<label class="col-sm-1 col-form-label">{{$personagem->classe->nome}}</label>
		</div>
	</div>

	<div class="form-group">
		<fieldset class="form-control">
			<legend>Atributos</legend>

			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<td>Vida</td>
						<td>Defesa</td>
						<td>Dano</td>
						<td>Velocidade de Ataque</td>
						<td>Velocidade de Movimento</td>
					</tr>
				</thead>

				<tr>
					<td>{{$personagem->pontos_vida}}</td>
					<td>{{$personagem->pontos_defesa}}</td>
					<td>{{$personagem->pontos_dano}}</td>
					<td>{{$personagem->velocidade_ataque}}</td>
					<td>{{$personagem->velocidade_movimento}}</td>
				</tr>
			</table>
		</fieldset>
	</div>

	<div class="form-group">
		<fieldset class="form-control">
			<legend>Especialidades</legend>

			@if($personagem->especialidades->count() > 0)
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<td>Nome</td>
						</tr>
					</thead>
					@foreach($personagem->especialidades as $especialidade)
						<tr>
							<td>{{$especialidade->nome}}</td>
						</tr>
					@endforeach
				</table>
			@else 
				<label>Nenhuma Especialidade cadastrada!</label>
			@endif
		</fieldset>
	</div>

	<hr>
	<a href="{{empty(Request::get('raid')) ? '/personagens' : '/raids/' . Request::get('raid')}}" class="btn btn-primary">Voltar</a>

@endsection