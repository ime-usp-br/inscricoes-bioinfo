@extends('layouts.app')

@section('content')
@parent
<div id="container">
    <div class="justify-content-center">
        <div class="col-md-12">
            <h1 class='text-center mt-4'>Fichas de Inscrição</h1>
            <h4 class='text-center pb-4'>{{ $periodo->semestre }} Semestre de {{ $periodo->ano }}</h4>

            @include('inscricoes.modals.escolherPeriodo')

            <p class="text-right">
                <a  id="btn-chooseSemesterModal"
                    class="btn btn-outline-primary"
                    data-toggle="modal"
                    data-target="#chooseSemesterModal"
                    title="Escolher Período" 
                >
                    Escolher Período
                </a>
            </p>


            @if (count($inscricoes) > 0)
                <table class="table table-bordered table-striped table-hover" style="font-size:15px;">
                    <tr>
                        <th>Protocolo</th>
                        <th>Modalidade</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Status Boleto</th>
                        <th></th>
                    </tr>

                    @foreach($inscricoes as $inscricao)
                        <tr class="text-center">
                            <td>{{ $inscricao->protocolo }}</td>
                            <td>{{ $inscricao->categoria }}</td>
                            <td>{{ $inscricao->nome }}</td>
                            <td>{{ $inscricao->email }}</td>
                            <td>{{ $inscricao->telefone }}</td>
                            <td>                                
                                @if($inscricao->boleto)
                                    {{$inscricao->boleto->getStatus(true)}}
                                @else
                                    Não Emitido
                                @endif
                            </td>

                            <td style="white-space:nowrap">
                                <a class="btn btn-outline-dark btn-sm"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Visualizar"
                                    href="{{ route('inscricoes.show', $inscricao) }}"
                                >
                                    Visualizar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="text-center">Não há inscrições cadastradas</p>
            @endif
        </div>
    </div>
</div>
@endsection