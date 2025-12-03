<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // INT (PK), Auto incremento
            
            // Relacionamento com a Empresa (multi-tenant)
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');            
            $table->string('nome', 100)->nullable(false); // Nome obrigatório
            $table->string('email', 100)->nullable();     // Opcional
            $table->string('nif', 20)->nullable();        // Para faturação
            $table->text('endereco')->nullable();         // Endereço opcional
            $table->timestamps();
            
            // Garante unicidade do NIF por empresa
            $table->unique(['empresa_id', 'nif']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
