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
        Schema::create('films', function (Blueprint $table) {
            $table->id("idFilm");
            $table->unsignedBigInteger("idCategoria");
            $table->string("titolo",45);
            $table->string("descrizione",255);
            $table->unsignedTinyInteger("durata");
            $table->string("regista",45);
            $table->string("attori",45);
            $table->unsignedSmallInteger("anno");
            $table->unsignedInteger("idImmagine");
            $table->unsignedInteger("idFilmato");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("idCategoria")->references("idCategoria")->on("categorie");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
