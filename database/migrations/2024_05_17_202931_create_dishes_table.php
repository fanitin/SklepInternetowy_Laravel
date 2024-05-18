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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('weight')->nullable();
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('dish_category_id')->nullable();

            $table->foreign('dish_category_id')->references('id')->on('dish_categories')->onDelete('set null');

            $table->string('image')->nullable();
            $table->string('dish_ingridients')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
