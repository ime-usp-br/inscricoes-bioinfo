<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreInscricaoRequest;
use App\Http\Requests\IndexInscricaoRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificaBioInfoSobreInscricao;
use App\Mail\BoletoDeInscricao;
use App\Models\Periodo;
use App\Models\Inscricao;
use App\Models\Anexo;
use App\Models\Boleto;
use App\Models\ModeloEmail;
use Session;
use Auth;

class InscricaoController extends Controller
{
    public function index(IndexInscricaoRequest $request)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria", "Docente"])){
            abort(403);
        }

        $validated = $request->validated();

        if(isset($validated['periodo_id'])){
            $periodo = Periodo::find($validated['periodo_id']);
        }else{
            $periodo = Periodo::getMaisRecente();
        }

        $inscricoes = Inscricao::whereBelongsTo($periodo)->get();

        return view("inscricoes.index", compact(["periodo", "inscricoes"]));


    }

    public function store(StoreInscricaoRequest $request)
    {
        $validated = $request->validated();

        $periodo = Periodo::getEmPeridoInscricao();

        if(!$periodo){
            Session::flash("alert-warning", "Fora do período de inscrição.");    
            return redirect("/");
        }

        $validated["periodo_id"] = $periodo->id;

        $protocoloValido = False;

        while(!$protocoloValido){
            $protocolo = str_pad(random_int(1,999999),6,"0",STR_PAD_LEFT);
            $protocoloValido = Inscricao::where("protocolo", $protocolo)->first() ? False : True;
        }

        $validated["protocolo"] = $protocolo;

        $inscricao = Inscricao::create($validated);

        $anexos = $validated["anexosNovos"] ?? [];
        unset($validated["anexosNovos"]);

        foreach($anexos as $anexo){
            $attachment  = new Anexo;
            
            $attachment->nome = $anexo["arquivo"]->getClientOriginalName();
            $attachment->caminho = $anexo["arquivo"]->store($protocolo);

            $inscricao->anexos()->save($attachment);

            $attachment->link = route("anexos.download",$attachment);
            $attachment->save();
        }

        $boleto = Boleto::gerarBoletoRegistrado($inscricao, 30.00, 0);

        if(!$boleto){
            Session::flash("alert-danger", "Sua inscrição foi registrada, porem ocorreu um ao gerar o boleto. Entre em contato com a secretaria da BioInfo e informe o protocolo ".$protocolo." para orientação de como proceder.");    
            return redirect("/");
        }

        $inscricao->boleto()->save($boleto);
        $inscricao->save();

        $modelo = ModeloEmail::where([
            "classe"=>"NotificaBioInfoSobreInscricao",
            "frequencia_envio"=>"A cada inscrição",
            "ativo"=>true
            ])->first();

        if($modelo){
            Mail::to(env("MAIL_PROGRAMA"))->queue(new NotificaBioInfoSobreInscricao($inscricao, $modelo));
        }

        $modelo = ModeloEmail::where([
            "classe"=>"BoletoDeInscricao",
            "frequencia_envio"=>"A cada inscrição",
            "ativo"=>true
            ])->first();

        if($modelo){
            Mail::to($inscricao->email)->queue(new BoletoDeInscricao($inscricao, $modelo));
        }

        Session::flash("alert-success", "Sua inscrição foi efetuada com sucesso! Seu número de protocolo é ".$protocolo.".");

        return redirect("/");
    }    

    public function show(Inscricao $inscricao)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria", "Docente"])){
            abort(403);
        }

        return view("inscricoes.show", compact("inscricao"));
    }
}
