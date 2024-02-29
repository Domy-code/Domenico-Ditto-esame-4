<?php

namespace Database\Seeders;

use App\Models\TipoRecapito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoRecapitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoRecapito::create([
            "idTipoRecapito"=>1,
            "nome"=>"domicilio"
        ]);
        TipoRecapito::create([
            "idTipoRecapito"=>2,
            "nome"=>"ufficio"
        ]);
        TipoRecapito::create([
            "idTipoRecapito"=>3,
            "nome"=>"residenza"
        ]);
    }
}
