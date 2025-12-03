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
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');  
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('numero', 50); // Número sequencial
            $table->decimal('valor_subtotal', 10, 2)->default(0.00); // Antes de impostos/descontos
            $table->decimal('valor_impostos', 10, 2)->default(0.00); // IVA, etc.
            $table->decimal('valor_descontos', 10, 2)->default(0.00); // Descontos aplicados
            $table->decimal('valor_total', 10, 2)->default(0.00); // Total final
            $table->string('arquivo_pdf')->nullable(); // Caminho do PDF gerado
            $table->string('nif_cliente', 20)->nullable(); // Snapshot do NIF do cliente

            // Status da Fatura
            $table->enum('status', ['pendente', 'parcialmente_pago', 'pago', 'cancelado'])->default('pendente');
            
            // Tipo de documento
            $table->enum('tipo', ['fatura', 'recibo', 'proforma'])->default('fatura');
            // Garante que o número da fatura seja único dentro da empresa
            $table->unique(['empresa_id', 'numero']);
            $table->date('data_vencimento')->nullable();
            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturas');
    }
};
