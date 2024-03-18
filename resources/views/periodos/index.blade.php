@extends('layouts.app')

@section('content')
@parent
<div id="container">
    <div class="justify-content-center">
        <div class="col-md-12">
            <h1 class='text-center mb-5'>Períodos</h1>

            <p class="text-right">
                <a class="btn btn-outline-primary" href="{{ route('periodos.create') }}">
                    <i class="fas fa-plus-circle"></i>
                    Cadastrar Período
                </a>
            </p>


            @if (count($periodos) > 0)
                <table class="table table-bordered table-striped table-hover" style="font-size:15px;">
                    <tr>
                        <th>Ano</th>
                        <th>Semestre</th>
                        <th>Data inicial das inscrições<br></th>
                        <th>Data final das inscrições<br></th>
                        <th></th>
                    </tr>

                    @foreach($periodos as $periodo)
                        <tr class="text-center">
                            <td>{{ $periodo->ano }}</td>
                            <td style="white-space: nowrap;">{{ $periodo->semestre }}</td>
                            <td>{{ $periodo->data_inicio_inscricoes }}</td>
                            <td>{{ $periodo->data_final_inscricoes }}</td>
                            <td>
                                <a class="text-dark text-decoration-none"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Editar"
                                    href="{{ route('periodos.edit', $periodo) }}"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="text-center">Não há períodos cadastrados</p>
            @endif
        </div>
    </div>
</div>

@endsection