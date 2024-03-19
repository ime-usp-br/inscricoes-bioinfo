<div class="custom-form-group align-items-center">
    <div class="col-md-12 text-lg-left">
        <label for="nome">Nome do Modelo*:</label>
    </div>
    <div class="col-md-12">
        <input class="custom-form-control" type="text" name="nome" id="name"
            value="{{ old('nome') ?? $modelo->nome ?? ''}}" 
        />
    </div>
</div>

<div class="custom-form-group align-items-center">
    <div class="col-md-12 text-lg-left">
        <label for="body">Aplicação*:</label>
    </div>
    <div class="col-md-12">
        <select class="custom-form-control" type="text" name="descricao_e_classe"
        >
                <option value="" {{ ($modelo->classe) ? '' : 'selected'}}></option>

            @foreach ([
                        "E-mail enviado a secretaria da BioInfo a cada inscrição"=>"NotificaBioInfoSobreInscricao",
                        "E-mail enviado ao inscrito no ato da inscrição"=>"BoletoDeInscricao",
                     ] as $key=>$value)
                <option value='{"descricao":"{{$key}}","classe":"{{$value}}"}' {{ ( $modelo->classe === $value) ? 'selected' : ''}}>{{ $key }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row custom-form-group">
    <div class="col-md">
        <div class="col-md-12 text-lg-left">
            <label for="frequencia_envio">Frequência de envio*:</label>
        </div>
        <div class="col-md-10">
            <select class="custom-form-control" type="text" name="frequencia_envio" id="sending_frequency"
            >
                    <option value="" {{ ($modelo->frequencia_envio) ? '' : 'selected'}}></option>

                @foreach ([
                            "A cada inscrição"
                        ] as $frequency)
                    <option value='{{$frequency}}' {{ ( $modelo->frequencia_envio === $frequency) ? 'selected' : ''}}>{{ $frequency }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="date-div" class="col-md">
        @if($modelo->frequencia_envio == "Única")
            <div class="col-12 text-left">
                <label for="data_envio">Data*:</label>
            </div>
            <div class="col-12">
                <input  class="custom-form-control custom-datepicker" style="max-width:130px" name="data_envio" autocomplete="off" value="{{ $modelo->data_envio }}">
            </div>
        @elseif($modelo->frequencia_envio == "Mensal")
            <div class="col-12 text-left">
                <label for="data_envio">Dia*:</label>
            </div>
            <div class="col-12">
                <input  class="custom-form-control" style="max-width:80px" type="number" min="1" max="31" name="data_envio" value="{{ $modelo->data_envio }}">
            </div>
        @endif
    </div>
    <div id="hour-div" class="col-md">
        @if($modelo->frequencia_envio == "Única" or $modelo->frequencia_envio == "Mensal")
            <div class="col-12 text-left">
                <label for="hora_envio">Hora*:</label>
            </div>
            <div class="col-12">
                <input class="custom-form-control" style="max-width:100px" name="hora_envio" type="time" value="{{ $modelo->hora_envio }}">
            </div>
        @endif
    </div>
</div>

<div class="custom-form-group align-items-center">
    <div class="col-md-12 text-lg-left">
        <label for="assunto">Assunto*:</label>
    </div>
    <div class="col-md-12">
        <input class="custom-form-control" type="text" name="assunto" id="subject"
            value="{{ old('assunto') ?? $modelo->assunto ?? ''}}" 
        />
    </div>
</div>

<div class="custom-form-group align-items-center">
    <div class="col-md-12 text-lg-left">
        <label for="corpo">Corpo*:</label>
    </div>
    <div class="col-md-12">
        <textarea class="custom-form-control" name="corpo" id="bodymailtemplate">{{ old('corpo') ?? $modelo->corpo ?? ''}}</textarea>
    </div>
</div>

<div class="row custom-form-group justify-content-center">
    <div class="col-sm-6 text-center text-sm-right my-1">
        <button type="submit" class="btn btn-outline-dark">
            {{ $buttonText }}
        </button>
    </div>
    <div class="col-sm-6 text-center text-sm-left my-1">
        <a class="btn btn-outline-dark"
            href="{{ route('modelosemails.index') }}"
        >
            Cancelar
        </a>
    </div>
</div>