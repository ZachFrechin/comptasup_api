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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('brand');
            $table->date('date');
            $table->string('carte_grise')->nullable();
            $table->unsignedBigInteger('profil_id')->nullable();
            $table->foreign('profil_id')->references('id')->on('profils');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
}; 