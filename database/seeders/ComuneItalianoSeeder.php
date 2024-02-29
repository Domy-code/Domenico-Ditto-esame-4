<?php

namespace Database\Seeders;

use App\Models\ComuneItaliano;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComuneItalianoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = storage_path("app/csv_db/comuniItaliani.csv");
        $file = fopen($csv, "r");
        while (($data = fgetcsv($file, 200, ";")) !== false) {
            ComuneItaliano::create(
                [
                    "idComune" => $data[0],
                   "nome" => $data[1],
                    "regione" => $data[2],
                    "provincia" => $data[3],
                    "sigla" => $data[4],
                    "codiceCatastale" => $data[5],
                    "cap" => $data[6]
                ]
            );
        }
    }
}
