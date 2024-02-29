<?php

namespace Database\Seeders;

use App\Models\SerieTv;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerieTVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SerieTv::create([
            "idSerieTv"=>1,
            "idCategoria" => 1,
            "nome" => "Serie TV 1",
            "descrizione" => "descrizione serie tv",
            "regista" => "nome regista",
            "attori" => "nome attore",
            "annoInizio" => "2020",
            "annoFine" => "2023",
            "idImmagine" => 1,
            "idFilmato" => 2
        ]);
        SerieTv::create([
            "idSerieTv"=>2,
            "idCategoria" => 1,
            "nome" => "Serie TV 2",
            "descrizione" => "descrizione serie tv",
            "regista" => "nome regista",
            "attori" => "nome attore",
            "annoInizio" => "2020",
            "annoFine" => "2023",
            "idImmagine" => 1,
            "idFilmato" => 2
        ]);
        SerieTv::create([
            "idSerieTv"=>3,
            "idCategoria" => 1,
            "nome" => "Serie TV 3",
            "descrizione" => "descrizione serie tv",
            "regista" => "nome regista",
            "attori" => "nome attore",
            "annoInizio" => "2020",
            "annoFine" => "2023",
            "idImmagine" => 1,
            "idFilmato" => 2
        ]);
        SerieTv::create([
            "idSerieTv"=>4,
            "idCategoria" => 1,
            "nome" => "Serie TV 1",
            "descrizione" => "descrizione serie tv",
            "regista" => "nome regista",
            "attori" => "nome attore",
            "annoInizio" => "2020",
            "annoFine" => "2023",
            "idImmagine" => 1,
            "idFilmato" => 2
        ]);
        SerieTv::create([
            "idSerieTv"=>5,
            "idCategoria" => 1,
            "nome" => "Serie TV 4",
            "descrizione" => "descrizione serie tv",
            "regista" => "nome regista",
            "attori" => "nome attore",
            "annoInizio" => "2020",
            "annoFine" => "2023",
            "idImmagine" => 1,
            "idFilmato" => 2
        ]);

    }
}
