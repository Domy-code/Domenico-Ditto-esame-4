<?php

namespace Database\Seeders;

use App\Models\SerieTv_Stagioni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerieTvStagioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SerieTv_Stagioni::create([
            "idSerieTv"=>1,
            "idStagione"=>1
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>1,
            "idStagione"=>2
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>1,
            "idStagione"=>3
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>1,
            "idStagione"=>4
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>2,
            "idStagione"=>5
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>2,
            "idStagione"=>6
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>3,
            "idStagione"=>7
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>4,
            "idStagione"=>8
        ]);
        SerieTv_Stagioni::create([
            "idSerieTv"=>4,
            "idStagione"=>9
        ]);
    }
}
