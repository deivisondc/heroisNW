@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Apresentação</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Sistema desenvolvido como desafio técnico para o processo de seleção da 
                    <a href="http://www.gruponewway.com.br/">New Way</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
