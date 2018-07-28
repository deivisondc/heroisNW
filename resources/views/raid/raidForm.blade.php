@extends('layouts.app')

@section('content')

	<form action="/raids/armazenar" method="post">
		
		@csrf

		<div class="form-group">
			<label>Descrição</label>
			<textarea name="descricao" maxlength="200" rows="3" class="form-control">
				
			</textarea>
		</div>
		<div class="form-group">
			<fieldset class="form-control">
				<legend>Personagens</legend>
				
				@if(!empty($personagens))
					@foreach($personagens as $personagem)
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="{{'chkPersonagem' . $personagem->id}}"
									name="personagem_array[]" value="{{$personagem->id}}">
							<label class="custom-control-label lbl-bold" for="{{'chkPersonagem' . $personagem->id}}">{{$personagem->nome}}</label>
							<label>{{$personagem->resumoDoPersonagem()}}</label>
						</div>
					@endforeach
				@else
					<label>Nenhum Personagem encontrado!</label>
				@endif
			</fieldset>
		</div>

		<hr>
		<button class="btn btn-primary">Salvar</button>
		<a href="/raids" class="btn btn-danger">Cancelar</a>

	</form>

@endsection