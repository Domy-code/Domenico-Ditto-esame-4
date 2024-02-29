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
        Schema::create('indirizzi', function (Blueprint $table) {
            $table->id("idIndirizzo");
            $table->unsignedBigInteger("idTipoIndirizzo");
            $table->unsignedBigInteger("idUtente");
            $table->unsignedBigInteger("idNazione");
            $table->unsignedBigInteger("idComune");
            $table->unsignedInteger("cap");
            $table->string("indirizzo",255);
            $table->string("civico")->nullable();
            $table->string("località");
            $table->float("lat")->nullable();
            $table->float("lng")->nullable();
            $table->timestamps();

          $table->foreign("idComune")->references("idComune")->on("comuniItaliani");
            $table->foreign("idTipoIndirizzo")->references("idTipoIndirizzo")->on("tipoIndirizzi");
            $table->foreign("idNazione")->references("idNazione")->on("nazioni");
            $table->foreign("idUtente")->references("idUtente")->on("utenti");
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indirizzi');
    }
};
