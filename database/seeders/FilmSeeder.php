<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::create([
            "idCategoria"=>1,
            "titolo"=>"titolo film 1",
            "descrizione"=>"descrizione film",
            "durata"=>90,
            "regista"=>"nome regista",
            "attori"=>"nome attori",
            "anno"=>2000,
            "idImmagine"=>10,
            "idFilmato"=>6  
        ]);
        Film::create([
            "idCategoria"=>3,
            "titolo"=>"titolo film 2",
            "descrizione"=>"descrizione film",
            "durata"=>90,
            "regista"=>"nome regista",
            "attori"=>"nome attori",
            "anno"=>2000,
            "idImmagine"=>10,
            "idFilmato"=>6  
        ]);
        Film::create([
            "idCategoria"=>2,
            "titolo"=>"titolo film 3",
            "descrizione"=>"descrizione film",
            "durata"=>90,
            "regista"=>"nome regista",
            "attori"=>"nome attori",
            "anno"=>2000,
            "idImmagine"=>10,
            "idFilmato"=>6  
        ]);

        Film::create([
            "idCategoria"=>4,
            "titolo"=>"titolo film 4",
            "descrizione"=>"descrizione film",
            "durata"=>90,
            "regista"=>"nome regista",
            "attori"=>"nome attori",
            "anno"=>2000,
            "idImmagine"=>10,
            "idFilmato"=>6  
        ]);
    }
}
