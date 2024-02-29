<?php

namespace Database\Seeders;

use App\Models\Configurazione;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Configurazione::create([
        'nome'=>'durataSessione',
        'valore'=>86400
       ]);
       Configurazione::create([
        'nome'=>'maxLoginFalliti',
        'valore'=>300
       ]);
       Configurazione::create([
        'nome'=>'durataSfida',
        'valore'=>100000
       ]);
       Configurazione::create([
        'nome'=>'storicoPsw',
        'valore'=>5
       ]);
    }
}
