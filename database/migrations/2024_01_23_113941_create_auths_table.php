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
        Schema::create('auths', function (Blueprint $table) {
            $table->id("idAuth");
            $table->unsignedBigInteger("idUtente");
            $table->string("user",200);
            $table->string("sfida",255)->nullable();
            $table->integer("inizioSfida")->nullable();
            $table->string("secretJWT",255)->nullable();
            $table->integer("scadenzaSfida")->nullable();
            $table->timestamps();

            $table->foreign("idUtente")->references("idUtente")->on("utenti");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auths');
    }
};
