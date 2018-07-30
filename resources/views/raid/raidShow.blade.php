@extends('layouts.app')

@section('content')

	<div class="form-group row">
		<label class="col-sm-1 col-form-label lbl-bold">Descrição</label>
		<div class="col-sm-10">
			<label class="col-sm-10 col-form-label">{{$raid->descricao}}</label>
		</div>
	</div>

	<div class="form-group">
		<fieldset class="form-control">
			<legend>Personagens</legend>

			@if($raid->personagens->count())
				@foreach($raid->personagens as $personagem)
					<a href="/personagens/{{$personagem->id}}?raid={{$raid->id}}" class="lbl-bold">{{$personagem->nome}}</a>
					<label>{{$personagem->resumoDoPersonagem()}}</label>
					<br>
				@endforeach
			@else
				<label>Nenhum Personagem participa desta Raid!</label>
			@endif
		</fieldset>
	</div>

	<hr>
	<a href="/raids" class="btn btn-primary">Voltar</a>

@endsection