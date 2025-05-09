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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->unique();
            $table->string('type'); // e.g., Sedan, SUV, MPV
            $table->string('transmission'); // e.g., Auto, Manual
            $table->string('brand');
            $table->string('model');
            $table->integer('branch_id'); // Foreign key to the branches table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
