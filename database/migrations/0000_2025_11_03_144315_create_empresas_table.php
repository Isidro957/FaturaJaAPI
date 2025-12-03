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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('nome'); // Nome da empresa
            $table->string('slug')->unique()->comment('Identificador único para URLs/subdomínios'); // Útil para multi-tenant
            $table->string('nif')->unique(); // Número de identificação fiscal
            $table->string('endereco')->nullable(); // Endereço opcional
            $table->string('email')->unique(); // E-mail da empresa
            $table->string('telefone')->nullable(); // Telefone opcional
            $table->string('logo')->nullable()->comment('Caminho da imagem da empresa'); // Logo opcional
            $table->timestamps(); // created_at e updated_at
        });

    }
    
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
