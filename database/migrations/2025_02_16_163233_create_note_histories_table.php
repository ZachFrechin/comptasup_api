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
        Schema::create('note_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('note_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('etat_base_id');
            $table->unsignedBigInteger('etat_final_id');
            $table->foreign('note_id')->references('id')->on('notes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('etat_base_id')->references('id')->on('etats');
            $table->foreign('etat_final_id')->references('id')->on('etats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_histories');
    }
};
