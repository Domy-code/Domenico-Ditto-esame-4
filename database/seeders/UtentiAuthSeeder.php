<?php

namespace Database\Seeders;

use App\Models\UtenteAuth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtentiAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UtenteAuth::create([
            'idUtente' => 2,
            'user' => 'user'
        ]);
        UtenteAuth::create([
            'idUtente' => 1,
            'user' => 'admin'
        ]);
    }
}
