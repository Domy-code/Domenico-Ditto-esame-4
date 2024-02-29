<?php

namespace Database\Seeders;

use App\Models\Ruolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruolo::create([
            'nome' => 'Admin',
            'idRuolo' => 1
        ]);
        Ruolo::create([
            'nome' => 'User',
            'idRuolo' => 2
        ]);
        
    }
}
