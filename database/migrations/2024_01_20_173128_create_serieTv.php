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
        Schema::create('serieTv', function (Blueprint $table) {
            $table->id("idSerieTv");
            $table->unsignedBigInteger("idCategoria");
            $table->string("nome",45);
            $table->string("descrizione",255);
            $table->string("regista",45);
            $table->string("attori",45);
            $table->unsignedInteger("annoInizio");
            $table->unsignedInteger("annoFine");
            $table->unsignedInteger("idImmagine");
            $table->unsignedInteger("idFilmato");
            $table->timestamps();

            $table->foreign("idCategoria")->references("idCategoria")->on("categorie");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serieTv');
    }
};
