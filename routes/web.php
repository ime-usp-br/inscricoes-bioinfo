<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\ModeloEmailController;
use App\Http\Controllers\AnexoController;
use App\Models\Periodo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $periodo = Periodo::getEmPeridoInscricao();
    return view('main', compact("periodo"));
})->name("home");

Route::resource("periodos",PeriodoController::class);
Route::resource("inscricoes",InscricaoController::class)->parameters(["inscricoes"=>"inscricao"]);

Route::post('/modelosemails/testar', [ModeloEmailController::class, 'testar'])->name('modelosemails.testar');
Route::get('/modelosemails/ativar/{modelo}', [ModeloEmailController::class, 'ativar'])->name('modelosemails.ativar');
Route::get('/modelosemails/desativar/{modelo}', [ModeloEmailController::class, 'desativar'])->name('modelosemails.desativar');
Route::resource("modelosemails",ModeloEmailController::class)->parameters(["modelosemails"=>"modelo"]);

Route::get("/anexo/download/{anexo}",[AnexoController::class, "download"])->name("anexos.download");