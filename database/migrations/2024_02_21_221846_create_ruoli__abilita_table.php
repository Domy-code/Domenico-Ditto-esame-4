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
        Schema::create('ruoli_abilita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUtenteAbilita');
            $table->unsignedBigInteger('idUtenteRuolo');
            $table->timestamps();
            $table->foreign('idUtenteAbilita')->references('idAbilita')->on('abilita');
            $table->foreign('idUtenteRuolo')->references('idRuolo')->on('ruoli');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruoli_abilita');
    }
};
