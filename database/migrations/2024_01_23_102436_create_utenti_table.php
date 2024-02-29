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
       
        Schema::create('utenti', function (Blueprint $table) {
           
            $table->id("idUtente");
            $table->string("nome");
            $table->string("cognome");
            $table->string('email')->nullable()->unique();
            $table->tinyInteger("sesso");
            $table->string("codiceFiscale",45);
            $table->string("cittadinanza",45);
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
