<?php

namespace Database\Seeders;

use App\Models\TipoIndirizzo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIndirizzoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoIndirizzo::create([
            "idTipoIndirizzo"=>1,
            "nome"=>"domicilio"
        ]);
        TipoIndirizzo::create([
            "idTipoIndirizzo"=>2,
            "nome"=>"ufficio"
        ]);
        TipoIndirizzo::create([
            "idTipoIndirizzo"=>3,
            "nome"=>"residenza"
        ]);
    }
}
