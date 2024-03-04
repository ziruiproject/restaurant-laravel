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
        Schema::create('food_image', function (Blueprint $table) {
            $table->id();
            // $table->integer('image_id');
            // $table->integer('food_id');

            $table->foreignId('image_id')->references('id')
                ->on('images')->onDelete('cascade');
            $table->foreignId('food_id')->references('id')
                ->on('food')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_image');
    }
};
