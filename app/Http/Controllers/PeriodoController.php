<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePeriodoRequest;
use App\Http\Requests\UpdatePeriodoRequest;
use App\Models\Periodo;
use Auth;

class PeriodoController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $periodos = Periodo::all()->sortBy(["ano","semestre"])->reverse();

        return view('periodos.index', compact('periodos'));
    }

    public function create()
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $periodo = new Periodo;

        return view('periodos.create', compact('periodo'));
    }

    public function store(StorePeriodoRequest $request)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        $validated = $request->validated();

        $periodo = Periodo::updateOrCreate(['ano'=>$validated['ano'], 'semestre'=>$validated['semestre']],$validated);

        return redirect(route("periodos.index"));
    }

    public function edit(Periodo $periodo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }

        return view('periodos.edit', compact('periodo'));
    }

    public function update(UpdatePeriodoRequest $request, Periodo $periodo)
    {
        if(!Auth::check()){
            return redirect("/login");
        }elseif(!Auth::user()->hasRole(["Administrador", "Secretaria"])){
            abort(403);
        }
        
        $validated = $request->validated();

        $periodo->update($validated);

        return redirect(route("periodos.index"));
    }
}
