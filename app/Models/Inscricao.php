<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Periodo;
use App\Models\Anexo;
use App\Models\Boleto;
use Carbon\Carbon;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricoes';

    protected $fillable = [
        'protocolo',
        'periodo_id',
        'categoria',
        'nome',
        'email',
        'nascimento',
        'nacionalidade',
        'rg',
        'cpf',
        'rnn_passaporte',
        'endereco',
        'telefone',
    ];

    protected $casts = [
        'nascimento' => 'date:d/m/Y',
    ];  

    public function setNascimentoAttribute($value)
    {
        $this->attributes['nascimento'] = Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
    }

    public function getNascimentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, "periodo_id");
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class, "inscricao_id");
    }

    public function boleto()
    {
        return $this->hasOne(Boleto::class, "inscricao_id");
    }
}
