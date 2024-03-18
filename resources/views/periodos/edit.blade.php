@extends('layouts.app')

@section('content')
@parent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class='text-center'>Editar Período</h1>

            <p class="alert alert-info rounded-0">
                <b>Atenção:</b>
                Os campos assinalados com * são de preenchimento obrigatório.
            </p>

            <form method="POST" action="{{ route('periodos.update', $periodo) }}" enctype='multipart/form-data'>
                @csrf
                @method('patch')
                @include('periodos.partials.form', ['buttonText' => 'Salvar'])
            </form>
        </div>
    </div>
</div>
@endsection