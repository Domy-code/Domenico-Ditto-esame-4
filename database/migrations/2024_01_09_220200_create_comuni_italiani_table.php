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
        Schema::create('comuniItaliani', function (Blueprint $table) {
            $table->id('idComune');
            $table->string('nome',45);
            $table->string('regione',45);
            $table->string('provincia',45);
            $table->char('sigla',2);
            $table->string('codiceCatastale',5);
            $table->string('cap',6);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comuniItaliani');
    }
};
