@extends('layouts.app')

@section('content')

	<?php function isAlteracao() { return Request::is('*/alterar');} ?>


	<form action="{{isAlteracao() ? '/personagens/' . $personagem->id : '/personagens'}}" method="post" enctype="multipart/form-data">
		
		@csrf
		@if(isAlteracao())
			@method('PUT')
		@endif

		<div class="form-group">
			
			<label>Nome</label>
			<input type="text" name="nome" class="form-control" maxlength="50" value="{{count($errors) > 0 ? old('nome') : (isAlteracao() ? $personagem->nome : '')}}">

			<label>Classe</label>
			@if(!empty($classes))
				<select class="form-control" name="classe_id">
					@foreach($classes as $classe)
						<option value="{{$classe->id}}" {{(count($errors) > 0 ? (integer) old('classe_id') : (isAlteracao() ? $personagem->classe->id : '')) == $classe->id ? 'selected' : ''}} >{{$classe->nome}}</option>
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
						<input type="number" name="pontos_vida" class="form-control" maxlength="10" min="0"
							   value="{{count($errors) > 0 ? old('pontos_vida') : (isAlteracao() ? $personagem->pontos_vida : '0')}}">
					</div>
					<div class="form-group col-md-2">
						<label>Defesa</label>
						<input type="number" name="pontos_defesa" class="form-control" maxlength="10"
						 	   value="{{count($errors) > 0 ? old('pontos_defesa') : (isAlteracao() ? $personagem->pontos_defesa : '0')}}">
					</div>
					<div class="form-group col-md-2">
						<label>Dano</label>
						<input type="number" name="pontos_dano" class="form-control" maxlength="10" min="0"
							   value="{{count($errors) > 0 ? old('pontos_dano') : (isAlteracao() ? $personagem->pontos_dano : '0')}}">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
						<label>Velocidade de Ataque</label>
						<input type="number" name="velocidade_ataque" step="0.1" class="form-control" maxlength="10" min="0"
							   value="{{count($errors) > 0 ? old('velocidade_ataque') : (isAlteracao() ? $personagem->velocidade_ataque : '0')}}">
					</div>
					<div class="form-group col-md-3">
						<label>Velocidade de Movimento</label>
						<input type="number" name="velocidade_movimento" class="form-control" maxlength="10" min="0"
						 	   value="{{count($errors) > 0 ? old('velocidade_movimento') : (isAlteracao() ? $personagem->velocidade_movimento : '0')}}">
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
									name="especialidade_array[]" value="{{$especialidade->id}}" 
									{{count($errors) > 0 ? (!empty(old('especialidade_array')) ? (in_array((string) $especialidade->id, old('especialidade_array')) ? 'checked' : '') : '') 
										: (isAlteracao() ? $personagem->especialidades->contains('id', $especialidade->id) ? 'checked' : '' : '')}}>
							<label class="custom-control-label" for="{{'chkEspecialidade' . $especialidade->id}}">{{$especialidade->nome}}</label>
						</div>
					@endforeach
				@else
					<label>Nenhuma Especialidade encontrada!</label>
				@endif
			</fieldset>

		</div>

		<div class="form-group">
			<fieldset class="form-control">
				<legend>Thumbmail</legend>
				
				<input type="file" class="form-control" name="imagem" accept="image/*">

				@if(!empty($personagem->thumbmail))
					<img src="/storage/{{$personagem->thumbmail}}" class="img-tamanho img-margem">

					<hr>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="chkExclusaoThumbmail" name="exclusao_thumbmail" >
						<label class="custom-control-label" for="chkExclusaoThumbmail">Marque a caixa para excluir a imagem</label>
					</div>
				@endif

			</fieldset>
		</div>

		<div class="form-group">
			<hr>
			<button class="btn btn-primary">Salvar</button>
			<a href="/personagens" class="btn btn-danger">Cancelar</a>
		</div>

	</form>

@endsection