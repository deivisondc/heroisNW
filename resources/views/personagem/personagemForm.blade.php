@extends('layouts.app')

@section('content')

	<form action="/personagens/armazenar" method="post">
		
		@csrf

		<div class="form-group">
			
			<label>Nome</label>
			<input type="text" name="nome" class="form-control">

			<label>Classe</label>
			@if(!empty($classes))
				<select class="form-control" name="classe_id">
					@foreach($classes as $classe)
						<option value="{{$classe->id}}">{{$classe->nome}}</option>
					@endforeach
				</select>
			@else
				<input type="number" name="classe_id" class="form-control" placeholder="Nenhuma classe encontrada!">
			@endif

		</div>

		<div class="form-group">
			<fieldset class="form-control">
				<legend>Atributos</legend>

				<div class="form-row">
					<div class="form-group col-md-2">
						<label>Vida</label>
						<input type="number" name="pontos_vida" class="form-control">
					</div>
					<div class="form-group col-md-2">
						<label>Defesa</label>
						<input type="number" name="pontos_defesa" class="form-control">
					</div>
					<div class="form-group col-md-2">
						<label>Dano</label>
						<input type="number" name="pontos_dano" class="form-control">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
						<label>Velocidade de Ataque</label>
						<input type="number" name="velocidade_ataque" step="0.1" class="form-control">
					</div>
					<div class="form-group col-md-3">
						<label>Velocidade de Movimento</label>
						<input type="number" name="velocidade_movimento" class="form-control">
					</div>
				</div>
			</fieldset>
		</div>

		<div class="form-group">
			<fieldset class="form-control">
				<legend>Especialidades</legend>

				@if(!empty($especialidades))

					@foreach($especialidades as $especialidade)
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="{{'chkEspecialidade' . $especialidade->id}}"
									name="especialidade_array[]" value="{{$especialidade->id}}">
							<label class="custom-control-label" for="{{'chkEspecialidade' . $especialidade->id}}">{{$especialidade->nome}}</label>
						</div>
					@endforeach
				@else
					<label>Nenhuma Especialidade encontrada!</label>
				@endif
			</fieldset>

			<hr>
			<button class="btn btn-primary">Salvar</button>
			<a href="/personagens" class="btn btn-danger">Cancelar</a>
		</div>

	</form>

@endsection