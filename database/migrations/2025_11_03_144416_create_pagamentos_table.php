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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            
            // Empresa para multi-tenant
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            
            // Fatura relacionada
            $table->foreignId('fatura_id')->constrained('faturas')->onDelete('cascade');

            // Valores financeiros
            $table->decimal('valor_pago', 12, 2)->default(0);
            $table->decimal('valor_desconto', 12, 2)->default(0);
            $table->decimal('valor_troco', 12, 2)->default(0);
            
            $table->date('data_pagamento');

            // Forma de pagamento
            $table->enum('metodo_pagamento', ['pix', 'cartao', 'boleto'])->default('boleto');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
