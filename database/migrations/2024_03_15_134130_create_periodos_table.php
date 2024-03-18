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
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ano');
            $table->string('semestre');
            $table->timestamp('data_inicio_inscricoes')->nullable();
            $table->timestamp('data_final_inscricoes')->nullable();
            $table->timestamps();
            $table->unique(['ano', 'semestre']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};
