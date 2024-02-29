<?php

namespace Database\Seeders;

use App\Models\Indirizzo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndirizzoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Indirizzo::create([
            "idIndirizzo"=>1,
            "idTipoIndirizzo"=>2,
            "idUtente"=>1,
            "idNazione"=>1,
            "idComune"=>1,
            "cap"=>89100,
            "indirizzo"=>"indirizzo prova",
            "civico"=>56,
            "località"=>"Roma",
            "lat"=>null,
            "lng"=>null
        ]);
       
    }
}
