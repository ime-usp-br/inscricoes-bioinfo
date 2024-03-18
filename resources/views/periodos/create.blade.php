@extends('layouts.app')

@section('content')
@parent
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class='text-center'>Cadastrar Período</h1>

            <p class="alert alert-info rounded-0">
                <b>Atenção:</b>
                Os campos assinalados com * são de preenchimento obrigatório.
            </p>

            <form method="POST" action="{{ route('periodos.store') }}" enctype='multipart/form-data'>
                @csrf
                @include('periodos.partials.form', ['buttonText' => 'Cadastrar'])
            </form>
        </div>
    </div>
</div>
@endsection