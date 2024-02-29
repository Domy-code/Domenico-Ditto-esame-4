<?php

namespace Database\Seeders;

use App\Models\Recapito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecapitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recapito::create([
            "idRecapito"=>1,
            "idUtente"=>1,
            "idTipoRecapito"=>1,
            "recapito"=>"123456789"
        ]);
    }
}
