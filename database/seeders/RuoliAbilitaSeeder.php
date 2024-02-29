<?php

namespace Database\Seeders;


use App\Models\Ruoli_Abilita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuoliAbilitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Ruoli_Abilita::create([
            "idUtenteAbilita"=>1,
            "idUtenteRuolo"=>1
        ]);
        Ruoli_Abilita::create([
            "idUtenteAbilita"=>2,
            "idUtenteRuolo"=>1
        ]);
        Ruoli_Abilita::create([
            "idUtenteAbilita"=>3,
            "idUtenteRuolo"=>1
        ]);
        Ruoli_Abilita::create([
            "idUtenteAbilita"=>4,
            "idUtenteRuolo"=>1
        ]);
        Ruoli_Abilita::create([
            "idUtenteAbilita"=>5,
            "idUtenteRuolo"=>1
        ]);
        Ruoli_Abilita::create([
            "idUtenteAbilita"=>1,
            "idUtenteRuolo"=>2
        ]);
        Ruoli_Abilita::create([
            "idUtenteAbilita"=>3,
            "idUtenteRuolo"=>2
        ]);
       
    }
}
