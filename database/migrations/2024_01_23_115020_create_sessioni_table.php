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
        Schema::create('sessioni', function (Blueprint $table) {
            $table->id("idSessione");
            $table->unsignedBigInteger(("idUtente"));
            $table->text("token");
            $table->integer("inizioSessione");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessione');
    }
};
