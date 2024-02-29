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
        Schema::create('serietv_stagioni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSerieTv');
            $table->unsignedBigInteger('idStagione');
            $table->timestamps();

            $table->foreign('idSerieTv')->references('idSerieTv')->on('serieTv');
            $table->foreign('idStagione')->references('idStagione')->on('stagioni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serietv_stagioni');
    }
};
