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
        Schema::create('modelos_emails', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("classe");
            $table->string("descricao", 256);
            $table->string("frequencia_envio");
            $table->string("data_envio")->nullable();
            $table->string("hora_envio")->nullable();
            $table->boolean("ativo")->default(false);
            $table->string("assunto",256);
            $table->text("corpo");
            $table->timestamps();
            $table->unique(['nome']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos_emails');
    }
};
