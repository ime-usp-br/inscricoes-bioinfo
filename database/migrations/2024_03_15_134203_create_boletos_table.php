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
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("inscricao_id")->nullable();
            $table->string('codigoIDBoleto', 255);
            $table->string('dataVencimentoBoleto')->nullable();
            $table->string('dataEfetivaPagamento')->nullable();
            $table->decimal('valorDocumento', 5,2);
            $table->decimal('valorDesconto', 5,2);
            $table->decimal('valorEfetivamentePago', 5,2)->default(0);
            $table->string('statusBoletoBancario', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
