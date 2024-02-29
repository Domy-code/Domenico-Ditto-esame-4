<?php

namespace Database\Seeders;

use App\Models\Contatto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContattoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contatto::create([
            "idContatto"=>1,
            "idGruppo"=>1,
            "idStato"=>1,
            "nome"=>"nomeAdmin",
            "cognome"=>"cognomeAdmin",
            "sesso"=>1,
            "codiceFiscale"=>"CODICEFISCALE",
            "cittadinanza"=>"Italiana",
            "idNazioneNascita"=>1,
            "cittaNascita"=>"Roma",
            "provinciaNascita"=>"Roma"
        ]);
        
    }
}
