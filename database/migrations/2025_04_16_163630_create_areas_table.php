<?php

// 2025_12_01_000005_create_areas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('areas', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('empresas');

            $table->string('name_area');
            $table->string('slogan_area', 2048)->nullable();
            $table->string('telefone_area', 2048)->nullable();
            $table->string('email_area')->nullable()->unique();
            $table->string('descricao_area', 2048)->nullable();

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('areas');
    }
};
