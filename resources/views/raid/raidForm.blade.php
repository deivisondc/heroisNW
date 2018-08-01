@extends('layouts.app')

@section('content')

	<?php function isAlteracao() { return Request::is('*/alterar');} ?>

	<form action="{{isAlteracao() ? '/raids/' . $raid->id : '/raids'}}" method="post">
		
		@csrf
		@if(isAlteracao())
			@method('PUT')
		@endif

		<div class="form-group">
			<label>Descrição</label>
			<textarea name="descricao" maxlength="200" rows="3"  class="form-control">{{count($errors) > 0 ? old('descricao') : (isAlteracao() ? $raid->descricao : '')}}</textarea>
		</div>
		<div class="form-group">
			<fieldset class="form-control">
				<legend>Personagens</legend>
				
				@if(!empty($personagens))
					@foreach($personagens as $personagem)
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="{{'chkPersonagem' . $personagem->id}}"
									name="personagem_array[]" value="{{$personagem->id}}"
									{{count($errors) > 0 ? (!empty(old('personagem_array')) ? (in_array((string) $personagem->id, old('personagem_array')) ? 'checked' : '') : '') 
										: (isAlteracao() ? $raid->personagens->contains('id', $personagem->id) ? 'checked' : '' : '')}} >
							<label class="custom-control-label lbl-bold" for="{{'chkPersonagem' . $personagem->id}}">{{$personagem->nome}}</label>
							<label>{{$personagem->resumoDoPersonagem()}}</label>
						</div>
					@endforeach
				@else
					<label>Nenhum Personagem encontrado!</label>
				@endif
			</fieldset>
		</div>

		<div class="form-group">
			<hr>
			<button class="btn btn-primary">Salvar</button>
			<a href="/raids" class="btn btn-danger">Cancelar</a>
		</div>

	</form>

@endsection