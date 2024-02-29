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
        Schema::create('recapiti', function (Blueprint $table) {
            $table->id("idRecapito");
            $table->unsignedBigInteger("idUtente");
            $table->unsignedBigInteger("idTipoRecapito");
            $table->string("recapito",45);
            $table->timestamps();

            $table->foreign("idTipoRecapito")->references("idTipoRecapito")->on("tipiRecapito");
            $table->foreign("idUtente")->references("idUtente")->on("utenti");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recapiti');
    }
};
