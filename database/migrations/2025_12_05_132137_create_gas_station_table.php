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
        Schema::create('gas_station', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Station Name
            $table->string('location')->nullable();    // Address / Area
            $table->string('contact_number')->nullable(); // Phone Number
            $table->string('fuel_types')->nullable();  // Petrol, Diesel, HOBC etc.
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_station');
    }
};
