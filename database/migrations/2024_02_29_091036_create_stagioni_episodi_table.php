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
        Schema::create('stagioni_episodi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idStagione");
            $table->unsignedBigInteger("idEpisodio");
            $table->timestamps();

            $table->foreign("idStagione")->references("idStagione")->on("stagioni");
            $table->foreign("idEpisodio")->references("idEpisodio")->on("episodi");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stagioni_episodi');
    }
};
