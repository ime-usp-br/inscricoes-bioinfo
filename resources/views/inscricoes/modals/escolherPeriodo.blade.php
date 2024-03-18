<div class="modal fade" id="chooseSemesterModal">
   <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Escolher outro Período</h4>
            </div>
            <form id="chooseSemesterForm" action="{{ route('inscricoes.index') }}" method="GET"
            enctype="multipart/form-data"
            >

            @csrf
            <div class="modal-body">
                <div class="row custom-form-group align-items-center">
                    <div class="col-12 col-lg-6 text-lg-right">
                        <label for="semester_id">Período</label>   
                    </div> 
                    <div class="col-12 col-md-5">

                        <select id="semester_id" name="periodo_id" class="custom-form-control">
                            @foreach(App\Models\Periodo::all() as $st)
                                <option value={{ $st->id }}>{{ $st->ano . " " . $st->semestre . " Semestre" }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-chooseSemester" class="btn btn-default" type="submit">Buscar</button>
                <button class="btn btn-default" type="button" data-dismiss="modal">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>