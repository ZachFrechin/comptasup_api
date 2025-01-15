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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->unsignedBigInteger('note_id')->nullable();
            $table->unsignedBigInteger('nature_id')->nullable();
            $table->string('totalTTC');
            $table->date('date');
            $table->string('tiers')->nullable();
            $table->json("details");
            $table->foreign('nature_id')->references('id')->on('natures');
            $table->foreign('note_id')->references('id')->on('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
