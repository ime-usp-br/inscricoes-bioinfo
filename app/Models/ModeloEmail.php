<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'classe',
        'descricao',
        'frequencia_envio',
        'data_envio',
        'hora_envio',
        'ativo',
        'assunto',
        'corpo',
    ];
}
