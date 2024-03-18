<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'ano',
        'semestre',
        'data_inicio_inscricoes',
        'data_final_inscricoes',
    ];

    protected $casts = [
        'data_inicio_inscricoes' => 'date:d/m/Y',
        'data_final_inscricoes' => 'date:d/m/Y',
    ];  

    public function setDataInicioInscricoesAttribute($value)
    {
        $this->attributes['data_inicio_inscricoes'] = Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
    }

    public function setDataFinalInscricoesAttribute($value)
    {
        $this->attributes['data_final_inscricoes'] = Carbon::createFromFormat('d/m/Y', $value)->endOfDay();
    }

    public function getDataInicioInscricoesAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getDataFinalInscricoesAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public static function getMaisRecente()
    {
        $ano = Periodo::max("ano");
        $semestre = Periodo::where("ano",$ano)->max("semestre");
        return Periodo::where(["ano"=>$ano,"semestre"=>$semestre])->first();
    } 

    public function estaEmPeriodoDeInscricao()
    {
        $today = Carbon::now();
        $start = Carbon::createFromFormat("d/m/Y", $this->data_inicio_inscricoes)->startOfDay();
        $end = Carbon::createFromFormat("d/m/Y", $this->data_final_inscricoes)->endOfDay();
        return ($start <= $today and $end >= $today);
    }

    public function getDataInicioInscricoes()
    {
        return Carbon::createFromFormat("d/m/Y", $this->data_inicio_inscricoes)->startOfDay();
    }

    public function getDataFinalInscricoes()
    {
        return Carbon::createFromFormat("d/m/Y", $this->data_final_inscricoes)->endOfDay();
    }

    public static function getEmPeridoInscricao(){
        return Periodo::where("data_inicio_inscricoes", "<=", now())->where("data_final_inscricoes", ">=", now())->first();
    }
}
