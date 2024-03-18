@extends('layouts.app')

@section('content')
@parent
<div id="layout_conteudo">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
            <h1 class='text-center mt-4'>Ficha de Inscrição</h1>
            <h4 class='text-center pb-4'>{{ $inscricao->periodo->semestre }} Semestre de {{ $inscricao->periodo->ano }}</h4>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Protolo:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->protocolo }}
                </div>        
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Data da inscricão:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->created_at }}
                </div>        
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Modalidade:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->categoria }}
                </div>        
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-left">
                    <label>Nome completo:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->nome }}
                </div>
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>E-mail:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->email }}
                </div>        
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Data de nascimento:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->nascimento }}
                </div>
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Nacionalidade:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->nacionalidade }}
                </div>
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>CPF:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->cpf }}
                </div>
            </div>

            @if($inscricao->rg)
                <div class="row custom-form-group d-flex align-items-center">
                    <div class="col-12 col-md-auto text-md-right">
                        <label>RG:</label>
                    </div>
                    <div class="col-12 col-md">
                        {{ $inscricao->rg }}
                    </div>
                </div>
            @endif

            @if($inscricao->rnn_passaporte)
                <div class="row custom-form-group d-flex align-items-center">
                    <div class="col-12 col-md-auto text-md-right">
                        <label>RNM ou passaporte:</label>
                    </div>
                    <div class="col-12 col-md">
                        {{ $inscricao->rnn_passaporte }}
                    </div>
                </div>
            @endif

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Telefone:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->telefone }}
                </div>
            </div>

            <div class="row custom-form-group d-flex align-items-center">
                <div class="col-12 col-md-auto text-md-right">
                    <label>Endereço:</label>
                </div>
                <div class="col-12 col-md">
                    {{ $inscricao->endereco }}
                </div>
            </div>

            <hr class="my-5">


            <div class="row custom-form-group d-flex align-items-center">
                    <div class="col-12 col-md-auto text-md-right">
                        <label>Boleto</label>
                    </div>
                    @if($inscricao->boleto)
                        <div class="col-12 col-md">      
                            <label>Status:</label> {{$inscricao->boleto->getStatus()}}<br>
                            <label>Valor do Documento:</label> {{$inscricao->boleto->valorDocumento}}<br>
                            <label>Data do Vencimento:</label> {{$inscricao->boleto->dataVencimentoBoleto}}<br>
                            <label>Valor Pago:</label> {{$inscricao->boleto->valorEfetivamentePago}}<br>
                            <label>Data do Pagamento:</label> {{$inscricao->boleto->dataEfetivaPagamento ?? "Não foi pago"}}<br>
                        </div>     
                    @else
                        <div class="col-12 col-md">                    
                            Não Emitido.
                        </div>     

                    @endif   
                </div>

            <hr class="my-5">

            <div class="custom-form-group mt-5">
                @if(!$inscricao->anexos->isEmpty())
                    <label class="text-justify">Anexo(s):</label>

                    @foreach($inscricao->anexos as $anexo)
                        <div class="col-12 pt-2">
                            <a href="{{ route('anexos.download', $anexo) }}">{{ $anexo->nome }}</a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 pt-2">
                        Não foram feitos anexos.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection