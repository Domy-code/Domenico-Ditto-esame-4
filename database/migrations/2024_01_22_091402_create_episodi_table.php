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
        Schema::create('episodi', function (Blueprint $table) {
            $table->id("idEpisodio");
            $table->string("titolo",45);
            $table->string("descrizione",255);
            $table->string("attori",255);
            $table->integer("numeroEpisodio");
            $table->unsignedTinyInteger("durata");
            $table->unsignedSmallInteger("anno");
            $table->unsignedInteger("idImmagine");
            $table->unsignedInteger("idFilmato");
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodi');
    }
};
