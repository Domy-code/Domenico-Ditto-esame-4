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
        Schema::create('utenti_stati', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUtente');
            $table->unsignedBigInteger('idStato');
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('utenti');
            $table->foreign('idStato')->references('idStato')->on('stati');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utenti_stati');
    }
};
