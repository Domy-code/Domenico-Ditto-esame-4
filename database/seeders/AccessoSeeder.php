<?php

namespace Database\Seeders;

use App\Models\Accesso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Accesso::create([
            "idUtente"=>1,
        ]);
        Accesso::create([
            "idUtente"=>2,
        ]);
    }
}
