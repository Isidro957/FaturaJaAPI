<?php
// 2025_12_01_000002_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            // multi tenant
            $table->foreignId('tenant_id')
                ->constrained()
                ->onDelete('cascade');

            // auth0
            $table->string('auth0_id')->unique()->nullable();

            $table->string('nome')->nullable();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('role')->default('Empresa');

            // NÃO precisa password porque Auth0 controla
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
};
