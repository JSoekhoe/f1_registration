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
        Schema::create('laps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lap_id'); // Assuming lap_id is an identifier for the lap
            $table->unsignedBigInteger('location_id'); // Foreign key to allowed_locations table
            $table->foreign('location_id')->references('id')->on('allowed_locations');
            $table->dateTime('lap_datetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laps');
    }
};
