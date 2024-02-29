<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

    

        $this->call([
            RuoloSeeder::class,
            TipoIndirizzoSeeder::class,
            NazioneSeeder::class,
            ComuneItalianoSeeder::class,
            StatoSeeder::class,
            UtenteSeeder::class,
            CategoriaSeeder::class,
            SerieTVSeeder::class,
            StagioneSeeder::class,
            EpisodioSeeder::class,
            FilmSeeder::class,
            TipoRecapitoSeeder::class,
            RecapitoSeeder::class,
            CreditoSeeder::class,
            SessioneSeeder::class,
            FilmHasContattiSeeder::class,
            IndirizzoSeeder::class,
            ConfigurazioneSeeder::class,
            PasswordSeeder::class,
            UtentiAuthSeeder::class,
            AbilitaSeeder::class,
            RuoliAbilitaSeeder::class,
            UtenteStatoSeeder::class,
            SerieTvStagioniSeeder::class,
            StagioniEpisodiSeeder::class
        ]);
     
    }
}
