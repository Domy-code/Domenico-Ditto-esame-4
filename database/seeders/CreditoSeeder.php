<?php

namespace Database\Seeders;

use App\Models\Credito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreditoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Credito::create([
            "idCredito"=>2,
            "idUtente"=>1,
            "credito"=>10
        ]);
    }
}
