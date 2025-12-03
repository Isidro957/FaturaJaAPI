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
        Schema::create('organizacoes', function (Blueprint $table) {
          $table->id();
          $table->string('name_org');
          $table->string('nif_org')->unique();
          $table->string('logo_org', 2048)->nullable();
          $table->string('telefone_org')->unique();
          $table->string('email_org')->unique();
          $table->string('provincia_org', 2048)->nullable();
          $table->string('regime_org', 2048)->nullable(); #Públia ou Privada
          $table->string('descricao_org', 2048)->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizacoes');
    }
};
