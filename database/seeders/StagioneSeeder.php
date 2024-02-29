<?php

namespace Database\Seeders;

use App\Models\Stagione;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StagioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stagione::create([
            "idStagione"=>1,
            "nome"=>"stagione 1"
        ]);
        Stagione::create([
            "idStagione"=>2,
            "nome"=>"stagione 2"
        ]);
        Stagione::create([
            "idStagione"=>3,
            "nome"=>"stagione 3"
        ]);
        Stagione::create([
            "idStagione"=>4,
            "nome"=>"stagione 4"
        ]);
        Stagione::create([
            "idStagione"=>5,
            "nome"=>"stagione 1"
        ]);
        Stagione::create([
            "idStagione"=>6,
            "nome"=>"stagione 2"
        ]);
        Stagione::create([
            "idStagione"=>7,
            "nome"=>"stagione 1"
        ]);
        Stagione::create([
            "idStagione"=>8,
            "nome"=>"stagione 1"
        ]);
        Stagione::create([
            "idStagione"=>9,
            "nome"=>"stagione 2"
        ]);
    }
}
