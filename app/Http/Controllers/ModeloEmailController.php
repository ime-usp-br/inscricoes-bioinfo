<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreModeloEmailRequest;
use App\Http\Requests\UpdateModeloEmailRequest;
use App\Models\ModeloEmail;
use Session;
use Auth;

class ModeloEmailController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $modelos = ModeloEmail::all();

        return view("modelosemails.index", compact("modelos"));
    }

    public function create()
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $modelo = new ModeloEmail;

        return view("modelosemails.create", compact("modelo"));
    }

    public function store(StoreModeloEmailRequest $request)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $validated = $request->validated();

        $descricao_e_classe = json_decode($validated["descricao_e_classe"]);
        $validated["descricao"] = $descricao_e_classe->descricao;
        $validated["classe"] = $descricao_e_classe->classe;
        unset($validated["descricao_e_classe"]);

        if(ModeloEmail::where("nome",$validated["nome"])->exists()){
            Session::flash('alert-warning', 'Já existe um modelo com esse nome.');
            return back();
        }

        ModeloEmail::create($validated);

        return redirect(route("modelosemails.index"));
    }

    public function edit(ModeloEmail $modelo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }
        
        return view("modelosemails.edit", compact("modelo"));
    }

    public function update(UpdateModeloEmailRequest $request, ModeloEmail $modelo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }
        
        $validated = $request->validated();

        $descricao_e_classe = json_decode($validated["descricao_e_classe"]);
        $validated["descricao"] = $descricao_e_classe->descricao;
        $validated["classe"] = $descricao_e_classe->classe;
        unset($validated["descricao_e_classe"]);
        
        if(ModeloEmail::where("nome",$validated["nome"])->where("id", "!=", $modelo->id)->exists()){
            Session::flash('alert-warning', 'Já existe um modelo com esse nome.');
            return back();
        }
        
        if(ModeloEmail::where("classe", $validated["classe"])
                ->where("id","!=", $modelo->id)
                ->where("ativo",true)->where("frequencia_envio", "Manual")->exists() and
                $validated["frequencia_envio"] == "Manual"){
            Session::flash('alert-warning', 'Já existe um modelo ativo com essa aplicação para disparo manual.');
            return back();
        }

        if($validated["frequencia_envio"]=="Manual"){
            $validated["data_envio"] = null;
            $validated["hora_envio"] = null;
        }

        $modelo->update($validated);

        return redirect(route("modelosemails.index"));
    }

    public function ativar(ModeloEmail $modelo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }
        
        if(ModeloEmail::where("classe", $modelo->classe)
                ->where("id","!=", $modelo->id)
                ->where("ativo",true)->where("frequencia_envio", "Manual")->exists() and
                $modelo->frequencia_envio == "Manual"){
            Session::flash('alert-warning', 'Já existe um modelo ativo com essa aplicação para disparo manual.');
            return back();
        }

        $modelo->ativo = true;
        $modelo->save();

        return redirect(route("modelosemails.index"));
    }

    public function desativar(ModeloEmail $modelo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $modelo->ativo = false;
        $modelo->save();

        return redirect(route("modelosemails.index"));
    }

    public function destroy(ModeloEmail $modelo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $modelo->delete();

        return back();
    }
}
