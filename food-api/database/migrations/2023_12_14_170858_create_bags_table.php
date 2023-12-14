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
        Schema::create("bags", function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignUuid('user_id')
            ->references('uuid')
            ->on('users')
            ->onDelete('cascade');
        });

        Schema::create("bag_items", function (Blueprint $table) {
            $table->id()->unique();
            $table->integer('quantity');
            $table->foreignUuid('food_id')
            ->references('id')
            ->on('foods')
            ->onDelete('cascade');
            $table->foreignId('bag_id')
            ->references('id')
            ->on('bags')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bags');
    }
};
