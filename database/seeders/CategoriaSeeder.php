<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            "idCategoria" => 1,
            "nome" => "Azione"
        ]);
        Categoria::create([
            "idCategoria" => 2,
            "nome" => "Avventura"
        ]);
        Categoria::create([
            "idCategoria" => 3,
            "nome" => "Animazione"
        ]);
        Categoria::create([
            "idCategoria" => 4,
            "nome" => "Horror"
        ]);

        Categoria::create([
            "idCategoria" => 5,
            "nome" => "Drammatico"
        ]);
        Categoria::create([
            "idCategoria" => 6,
            "nome" => "Commedia"
        ]);
        Categoria::create([
            "idCategoria" => 7,
            "nome" => "Thriller"
        ]);
        Categoria::create([
            "idCategoria" => 8,
            "nome" => "Fantascienza"
        ]);

        Categoria::create([
            "idCategoria" => 9,
            "nome" => "Sentimentale"
        ]);
        Categoria::create([
            "idCategoria" => 10,
            "nome" => "Fantasy"
        ]);
        Categoria::create([
            "idCategoria" => 11,
            "nome" => "Documentario"
        ]);
        Categoria::create([
            "idCategoria" => 12,
            "nome" => "Storico"
        ]);
    }
}
