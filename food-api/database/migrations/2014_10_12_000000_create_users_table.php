<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{

        Schema::create("roles", function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->uuid()->default(DB::raw('(UUID())'))->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('phone_number')->default('');
            $table->foreignId('role_id')
            ->references('id')
            ->on('roles')
            ->onDelete('cascade');
        });

        Schema::create("addresses", function (Blueprint $table) {
            $table->id()->unique();
            $table->string('country');
            $table->string('city');
            $table->string('zip_code');
            $table->foreignUuid('user_id')
            ->references('uuid')
            ->on('users')
            ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
