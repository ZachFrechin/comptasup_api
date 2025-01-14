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
        Schema::create('etats', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('commentaire')->nullable();
            $table->unsignedBigInteger('etat_id')->default(1)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('validateur_id')->nullable();
            $table->unsignedBigInteger('controleur_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('validateur_id')->references('id')->on('users');
            $table->foreign('controleur_id')->references('id')->on('users');
            $table->foreign('etat_id')->references('id')->on('etats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
        Schema::dropIfExists('etats');
    }
};
