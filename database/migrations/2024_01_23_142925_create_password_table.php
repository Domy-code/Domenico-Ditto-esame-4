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
        Schema::create('password', function (Blueprint $table) {
            $table->id("idPassword");
            $table->unsignedBigInteger("idUtente");
            $table->string("psw",255);
            $table->string("sale",255);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("idUtente")->references("idUtente")->on("utenti");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password');
    }
};
