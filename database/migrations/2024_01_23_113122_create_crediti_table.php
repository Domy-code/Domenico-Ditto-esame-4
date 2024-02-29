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
        Schema::create('crediti', function (Blueprint $table) {
            $table->id("idCredito");
            $table->unsignedBigInteger("idUtente");
            $table->integer("credito");
            $table->timestamps();

            $table->foreign("idUtente")->references("idUtente")->on("utenti");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crediti');
    }
};
