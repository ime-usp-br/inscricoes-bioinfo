@extends('layouts.app')

@section('content')
@parent

<div id="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-9 col-md-8 col-lg-7 col-xl-6">
            @if($periodo)
                <h1 class='text-center mt-4'>Formulário de Inscrição</h1>
                <h3 class='text-center'>Programa de Pós-graduação em Bioinformática</h3>
                <h4 class='text-center pb-4'>{{ $periodo->semestre }} Semestre de {{ $periodo->ano }}</h4>


                <div id="div-info">
                </div>

                <form id="form-inscricao" method="POST" action="{{ route('inscricoes.store') }}" enctype='multipart/form-data'>
                    @csrf



                    <p class="alert alert-info">Prazo de inscrição: {{ $periodo->data_inicio_inscricoes }} a {{ $periodo->data_final_inscricoes }} às 23:59:59 (horário de Brasília).</p>
                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label>Categoria:</label>
                        </div>
                        <div class="col-12 col-md">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="categoria" value="Mestrado" required {{ old("categoria")=="Mestrado" ? "checked" : "" }}>
                                <label class="font-weight-normal">Mestrado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="categoria" value="Doutorado" required {{ old("categoria")=="Doutorado" ? "checked" : "" }}>
                                <label class="font-weight-normal">Doutorado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="categoria" value="Doutorado Direto" required {{ old("categoria")=="Doutorado Direto" ? "checked" : "" }}>
                                <label class="font-weight-normal">Doutorado Direto</label>
                            </div>
                        </div>
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="nome">Nome completo:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="nome" id="nome" required value={{ old("nome") ?? '' }}>
                        </div>        
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="email">E-mail:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="email" id="email" required value={{ old("email") ?? '' }}>
                        </div>
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="emailConfirmation">Repetir e-mail:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="emailConfirmation" id="emailConfirmation">
                        </div>
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="nascimento">Data de nascimento:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="nascimento" id="nascimento" required value={{ old("nascimento") ?? '' }}>
                        </div>        
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="nacionalidade">Nacionalidade:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="nacionalidade" id="nacionalidade" required value={{ old("nacionalidade") ?? '' }}>
                        </div>        
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="rg">RG:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="rg" id="rg" value={{ old("rg") ?? '' }}>
                        </div>        
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="cpf">CPF:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="cpf" id="cpf" required value={{ old("cpf") ?? '' }}>
                        </div>        
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="rnm_passaporte">RNM ou passaporte:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="rnm_passaporte" id="rnm_passaporte" value={{ old("rnm_passaporte") ?? '' }}>
                        </div>        
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="endereco">Endereço completo:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="endereco" id="endereco" required value={{ old("endereco") ?? '' }}>
                        </div>
                    </div>

                    <div class="row custom-form-group d-flex align-items-center">
                        <div class="col-12 col-md-auto text-md-right">
                            <label for="telefone">Telefone para contato:</label>
                        </div>
                        <div class="col-12 col-md">
                            <input class="custom-form-control" type="text" name="telefone" id="telefone" required value={{ old("telefone") ?? '' }}>
                        </div>
                    </div>

                    <hr class="my-5">

                    <p class="alert alert-info">
                        ENVIO DOS DOCUMENTOS DEVERÃO SER EM ARQUIVOS PDF<br>
                        Histórico Escolar de Graduação oficial (acompanhado de assinatura ou código de
                        autenticidade)<br><br>

                        Histórico Escolar de Mestrado (inscrição no Curso de Doutorado)<br><br>

                        Curriculum Vitae ou Curriculo Lattes em pdf<br><br>

                        Carta de interesse assinada<br>
                        Projeto de pesquisa em pdf (somente para inscrição no Curso de Doutorado Direto)<br><br>

                        OPCIONAL: resultado do POSCOMP ou GRE em pdf, se tiver (ver no edital do processo seletivo
                        para detalhes.
                    </p>
                    <div class="custom-form-group mt-5">
                        <label class="text-justify">Documentação Completa:</label>

                        <div class="col-lg pt-2">
                            <div id="novos-anexos"></div>
                                <label class="font-weight-normal">Adicionar anexo</label> 
                                <input id="count-new-attachment" value=0 type="hidden" disabled>
                                <a class="btn btn-link btn-sm text-dark text-decoration-none" id="btn-addAttachment" 
                                    title="Adicionar novo anexo">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                        </div>
                    </div> 

                    <hr class="my-5">

                    <div class="custom-form-group mt-5">
                        <div class="col-12">
                            <canvas id="canvas" style="width: 220px;height: 88px;"></canvas>
                        </div>
                        <div class="col-12">
                            <label>Digite os 4 caracteres acima:</label>
                        </div>
                        <div class="col-12">
                            <input name="captchafield" style="width:220px;" required/>
                        </div>
                    </div>

                    <p class="alert alert-info">
                    Para confirmar a inscrição, deverá efetuar o pagamento do boleto no valor de R$ 30,00 (trinta reais).<br><br>

                    Não efetuamos devolução em caso de desistência.
                    </p>
                    <div class="row custom-form-group justify-content-center mt-5">
                        <button id="btn-submit" type="submit" class="btn btn-outline-dark">
                            Enviar Inscrição
                        </button>
                    </div>
                </form>
            @else
                <div class="alert alert-danger" role="alert">
                    Fora do período de inscrição.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('javascripts_bottom')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{ asset('js/jquery-captcha.min.js').'?version=1' }}"></script>
<script>
    jQuery.validator.addMethod("confirmacaoEmail", function(value, element) {
        return value == document.getElementById("email").value;
    }, "E-mails não conferem.");
    jQuery.validator.addMethod("validateEmail", function(value, element) {
        var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return filter.test(value);
    }, "E-mail invalido.");
    jQuery.validator.addMethod('filesize', function (value, element, param) {
        var soma = 0;
        $("input[type=file]").each(function(index, elem){
            soma = soma + elem.files[0].size
        });
        return soma <= param * 1000000;
    }, 'A soma do tamanho dos arquivos não deve ultrapassar {0} MB');
    const captcha = new Captcha($('#canvas'),{autoRefresh: false});
    jQuery.validator.addMethod("validatedCaptcha", function(value, element) {
        return captcha.valid(value);
    }, "Wrong sequence");
    jQuery.validator.addMethod("validateCPFCNPJ", function(value, element) {
        var valor = value.replace(/[^0-9]/g, '');
        if(valor.length == 11){
            var cpf = valor;
            var soma;
            var resto;
            soma = 0;
            if(cpf == "00000000000"){
                return false;
            }
            for(i=1; i<=9; i++){
                soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i); 
            }
            resto = (soma * 10) % 11;
            if((resto == 10) || (resto == 11)){
                resto = 0;
            }
            if(resto != parseInt(cpf.substring(9, 10))){
                return false;
            }
            soma = 0;
            for(i=1; i<=10; i++){
                soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
            }
            resto = (soma * 10) % 11;
            if((resto == 10) || (resto == 11)){
                resto = 0;
            }
            if(resto != parseInt(cpf.substring(10, 11))){
                return false;
            }
            return true;
        }else if(valor.length == 14){
            var cnpj = valor;
            var soma;
            var resto;
            soma = 0;
            for(i=1; i<=4; i++){
                soma = soma + parseInt(cnpj.substring(i-1, i)) * (6 - i); 
            }
            for(i=5; i<=12; i++){
                soma = soma + parseInt(cnpj.substring(i-1, i)) * (14 - i); 
            }
            resto = soma % 11;
            if((resto == 0) || (resto == 1)){
                if(parseInt(cnpj.substring(12, 13)) != 0){
                    return false;
                }
            }else{
                if(parseInt(cnpj.substring(12, 13)) != (11 - resto)){
                    return false;
                }
            }
            soma = 0;
            for(i=1; i<=5; i++){
                soma = soma + parseInt(cnpj.substring(i-1, i)) * (7 - i); 
            }
            for(i=6; i<=13; i++){
                soma = soma + parseInt(cnpj.substring(i-1, i)) * (15 - i); 
            }
            resto = soma % 11;
            if((resto == 0) || (resto == 1)){
                if(parseInt(cnpj.substring(13, 14)) != 0){
                    return false;
                }
            }else{
                if(parseInt(cnpj.substring(13, 14)) != (11 - resto)){
                    return false;
                }
            }
            return true;
        }
        return false;
    }, "Invalid number");
    $("#form-inscricao").validate({
        rules : {
            email: {
                validateEmail: true,
            },
            emailConfirmation: {
                confirmacaoEmail: true
            },
            rg: {
                required: function(element){
                  return $("#rnm_passaporte").val()=="";
                }
            },
            cpf : {
                required: true,
                validateCPFCNPJ : true
            },
            rnm_passaporte: {
                required: function(element){
                  return $("#rg").val()=="";
                }
            },
            captchafield: {
                required: true,
                validatedCaptcha: true
            },
            paymentVoucher:{
                filesize: 8
            }
        },
        errorPlacement: function(error,element){ 
            element.attr("data-toggle", "tooltip");
            element.attr("data-placement", "top");
            element.attr("title", error.text());
            $('[data-toggle="tooltip"]').tooltip();          
        },
        success: function(label,element){
            element.removeAttribute("data-toggle");
            element.removeAttribute("data-placement");
            element.removeAttribute("title");     
            element.removeAttribute("data-original-title");       
        },
        submitHandler: function (form) {
            $("#btn-submit").attr('disabled', true);
            form.submit();
        }
    });
    $(window).on('load', function() {      
      $("#cpf").mask("999.999.999-99");
      $("#nascimento").mask("99/99/9999");
    });
    function removeAnexo(id){   
        $('#anexoNovo'+id).rules("remove")
        document.getElementById("anexo-"+id).remove();
    }
    $('#btn-addAttachment').on('click', function(e) {
      var count = document.getElementById('count-new-attachment');
      var id = parseInt(count.value)+1;
      count.value = id;
      var html = ['<div class="row custom-form-group justify-content-start" id="anexo-new'+id+'">',
          '<div class="col-lg-auto">',
          '<a class="btn btn-link btn-sm text-dark text-decoration-none"',
          '    style="padding-left:0px"',
          '    id="btn-remove-anexo-new'+id+'"',
          '    onclick="removeAnexo(\'new'+id+'\')"',
          '>',
          '    <i class="fas fa-trash-alt"></i>',
          '</a>',
          '<input class="custom-form-input btn-sm" id="anexoNovo'+id+'" name="anexosNovos[new'+id+'][arquivo]" type="file" >',
          '<br/>',
      '</div></div>'].join("\n");
      $('#novos-anexos').append(html);
      $('#anexoNovo'+id).rules("add",{filesize:8})
    });
</script>
@endsection