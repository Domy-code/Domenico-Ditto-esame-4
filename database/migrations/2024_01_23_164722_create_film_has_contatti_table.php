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
        Schema::create('film_has_contatti', function (Blueprint $table) {
            $table->unsignedBigInteger("idFilm");
            $table->unsignedBigInteger("idUtente");
            $table->timestamps();

            $table->foreign("idFilm")->references("idFilm")->on("films");
            //$table->foreign("idContatto")->references("idContatto")->on("contatti");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_has_contatti');
    }
};
