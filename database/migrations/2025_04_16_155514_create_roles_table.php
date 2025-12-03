<?php
// 2025_12_01_000003_create_roles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Admin, Empresa, Cliente
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('roles');
    }
};
