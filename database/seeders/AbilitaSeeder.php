<?php

namespace Database\Seeders;

use App\Models\Abilita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbilitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Abilita::create([
            "nome"=>"Leggere",
            "sku"=>"leggere"
        ]);
        Abilita::create([
            "nome"=>"Creare",
            "sku"=>"creare"
        ]);
        Abilita::create([
            "nome"=>"Aggiornare",
            "sku"=>"aggiornare"
        ]);
        Abilita::create([
            "nome"=>"Eliminare",
            "sku"=>"eliminare"
        ]);
        Abilita::create([
            "nome"=>"Aggiungere",
            "sku"=>"aggiungere"
        ]);
    }
}
