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

        DB::table('roles')->insert([
            [ 
             'name' => 'user',
             ],
            [ 
             'name' => 'seller',
             ],
            [ 
             'name' => 'admin',
             ],
             
         ]);

        Schema::create('users', function (Blueprint $table) {
            $table->uuid()->default(DB::raw('(UUID())'))->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignId('role_id')
            ->default(1)
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
