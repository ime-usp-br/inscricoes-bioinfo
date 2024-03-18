<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anexo;
use Illuminate\Support\Facades\Storage;

class AnexoController extends Controller
{
    public function download(Anexo $anexo)
    {
        $tmp = explode(".",$anexo->caminho);

        $ext = !str_contains($anexo->nome, "." . end($tmp)) ? "." . end($tmp) : "";

        return Storage::download($anexo->caminho, $anexo->nome . $ext);
    }    
}
