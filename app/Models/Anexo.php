<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inscricao;


class Anexo extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'nome',
        'caminho',
        'inscricao_id',
        'link',
    ];

    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class, "inscricao_id");
    }
}
