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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->foreign('org_id')->references('id')->on('organizacoes');
            $table->string('name_area');
            $table->string('slogan_area', 2048)->nullable(); # Exemplo: TI = tecnologia de Informação
            $table->string('telefone_area', 2048)->nullable();
            $table->string('email_area')->nullable()->unique();
            $table->string('descricao_area', 2048)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
