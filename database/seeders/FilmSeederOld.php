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
            'titolo'=>'Film1'
        ]);
        Film::create([
            'titolo'=>'Film2'
        ]);
        Film::create([
            'titolo'=>'Film3'
        ]);
        Film::create([
            'titolo'=>'Film4'
        ]);
        Film::create([
            'titolo'=>'Film5'
        ]);
        Film::create([
            'titolo'=>'Film6'
        ]);
    }
}
