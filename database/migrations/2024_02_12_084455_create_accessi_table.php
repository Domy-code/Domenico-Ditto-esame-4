<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Accessi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUtente');
            $table->tinyInteger('autenticato')->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();

            $table->foreign('idUtente')->references('idUtente')->on('utenti');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utentiAccessi');
    }
};
