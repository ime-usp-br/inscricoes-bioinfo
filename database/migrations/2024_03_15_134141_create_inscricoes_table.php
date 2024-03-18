<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('protocolo')->unsigned();
            $table->unsignedInteger("periodo_id");
            $table->enum("categoria",["Mestrado","Doutorado","Doutorado Direto"]);
            $table->string("nome");
            $table->string("email");
            $table->timestamp("nascimento");
            $table->string("nacionalidade");
            $table->string("rg")->nullable();
            $table->string("cpf")->nullable();
            $table->string("rnm_passaporte")->nullable();
            $table->string("endereco");
            $table->string("telefone");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
