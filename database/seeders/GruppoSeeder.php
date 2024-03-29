<?php

namespace Database\Seeders;

use App\Models\Gruppo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GruppoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gruppo::create([
            "idGruppo"=>1,
            "nome"=>"Admin"
        ]);
        Gruppo::create([
            "idGruppo"=>2,
            "nome"=>"User"
        ]);
    }
}
