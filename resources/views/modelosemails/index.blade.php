@extends('layouts.app')

@section('content')
@parent
<div id="container">
    <div class="justify-content-center">
        <div class="col-md-12">
            <h1 class='text-center mb-5'>E-mails</h1>

            @include('modelosemails.modals.testarmodelo')
            <p class="text-right">
                <a  class="btn btn-outline-primary my-1"
                    title="Cadastrar Novo Modelo" 
                    href="{{ route('modelosemails.create') }}"
                >
                    <i class="fas fa-plus-circle"></i>
                    Cadastrar Novo Modelo
                </a>
                <a  id="btn-addTestTemplateModal"
                    class="btn btn-outline-primary my-1"
                    data-toggle="modal"
                    data-target="#testTemplateModal"
                    title="Enviar E-mail de Teste" 
                >
                    <i class="icon-envelope"></i>
                    Testar Modelo
                </a>
            </p>

            @if (count($modelos) > 0)
                <table class="table table-bordered table-striped table-hover" style="font-size:12px;">
                    <tr>
                        <th>Nome do Modelo</th>
                        <th>Descrição</th>
                        <th>Frequência</th>
                        <th>Em Uso</th>
                        <th></th>
                    </tr>

                    @foreach($modelos as $modelo)
                        <tr style="font-size:12px;">
                            <td style="text-align: center">{{ $modelo->nome }}</td>
                            <td>{{ $modelo->descricao }}</td>
                            <td style="text-align: center">
                                @if($modelo->frequencia_envio == "Única")
                                    {{  "Única - " .$modelo->data_envio . " às " .$modelo->hora_envio }}
                                @elseif($modelo->sending_frequency == "Mensal")
                                    {{  "Mensal - Dia " .$modelo->data_envio . " às " .$modelo->hora_envio }}
                                @elseif($modelo->frequencia_envio == "Inicio do período de avaliação")
                                    @if($modelo->data_envio==0)
                                        {{  "Primeiro dia do período de avaliação às " .$modelo->hora_envio }}
                                    @else
                                        {{  $modelo->data_envio ." dia".( $modelo->data_envio > 1 ? "s" : "" )." após o inicio do período de avaliação às " .$mailtemplate->hora_envio }}
                                    @endif
                                @elseif($modelo->frequencia_envio == "Final do período de avaliação")
                                    @if($modelo->data_envio==0)
                                        {{  "Ultimo dia do período de avaliação às " .$modelo->hora_envio }}
                                    @else
                                        {{  $modelo->data_envio ." dia".( $modelo->data_envio > 1 ? "s" : "" )." antes do fim do período de avaliação às " .$mailtemplate->hora_envio }}
                                    @endif
                                @else
                                    {{ $modelo->frequencia_envio }}
                                @endif

                            </td>
                            <td style="text-align: center">
                                {{ $modelo->ativo ? "Sim" : "Não" }}
                                @if($modelo->ativo)
                                    <a href="{{ route('modelosemails.desativar', $modelo) }}" title="Desabilitar Modelo"><i style="color:green" class="fa fa-toggle-on"></i></a>
                                @else
                                    <a href="{{ route('modelosemails.ativar', $modelo) }}" title="Habilitar Modelo"><i style="color:red" class="fa fa-toggle-off"></i></a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('modelosemails.edit', $modelo) }}" 
                                class="btn px-0" title="Editar Modelo">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="post"  action="{{ route('modelosemails.destroy',$modelo) }}" style="display: inline;">
                                    @method('delete')
                                    @csrf
                                    <button class="btn px-0"
                                        onclick="return confirm('Você tem certeza que deseja excluir esse modelo?')" 
                                        title="Excluir Modelo" >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </form>
            @else
                <p class="text-center">Não há modelos de e-mails cadastrados.</p>
            @endif
        </div>
    </div>
</div>
@endsection