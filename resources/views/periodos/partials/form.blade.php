<div class="row custom-form-group justify-content-center">
    <div class="col-12 col-md-6 text-md-right">
        <label for="ano">Ano *</label>
    </div>
    <div class="col-12 col-md-6">
        <input class="custom-form-control" style="max-width:200px;" style="max-width:200px;" type="text" name="ano" id="ano"
            value='{{ $periodo->ano ?? ""}}'
        />
    </div>
</div>

<div class="row custom-form-group align-items-center">
    <div class="col-12 col-md-6 text-md-right">
        <label for="semestre">Semestre *</label>
    </div>
    <div class="col-12 col-md-6">
        <select class="custom-form-control" style="max-width:200px;" type="text" name="semestre"
            id="semestre"
        >
            <option value="" {{ ( $periodo->semestre) ? '' : 'selected'}}></option>

            @foreach ([
                        '1°',
                        '2°',
                     ] as $semestre)
                <option value="{{ $semestre }}" {{ ( $periodo->semestre === $semestre) ? 'selected' : ''}}>{{ $semestre }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row custom-form-group align-items-center">
    <div class="col-12 col-md-6 text-md-right">
        <label for="data_inicio_inscricoes">Data inicial das inscrições*</label>
    </div>

    <div class="col-12 col-md-6" style="white-space: nowrap;">
        <input class="custom-form-control custom-datepicker" style="max-width:200px;"
            type="text" name="data_inicio_inscricoes" id="data_inicio_inscricoes" autocomplete="off"
            value="{{ old('data_inicio_inscricoes') ?? $periodo->data_inicio_inscricoes ?? ''}}"
        />
    </div>
</div>

<div class="row custom-form-group align-items-center">
    <div class="col-12 col-md-6 text-md-right">
        <label for="data_final_inscricoes">Data final das inscrições*</label>
    </div>

    <div class="col-12 col-md-6" style="white-space: nowrap;">
        <input class="custom-form-control custom-datepicker" style="max-width:200px;"
            type="text" name="data_final_inscricoes" id="data_final_inscricoes" autocomplete="off"
            value="{{  old('data_final_inscricoes') ?? $periodo->data_final_inscricoes ?? ''}}"
        />
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
            href="{{ route('periodos.index') }}"
        >
            Cancelar
        </a>
    </div>
</div>