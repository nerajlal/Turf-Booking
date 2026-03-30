<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turfs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('price_per_hour', 10, 2);
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->json('amenities')->nullable(); // Wi-Fi, Parking, Changing Room, etc.
            $table->time('opening_hours')->default('06:00:00');
            $table->time('closing_hours')->default('23:00:00');
            $table->decimal('rating_avg', 3, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turfs');
    }
};
