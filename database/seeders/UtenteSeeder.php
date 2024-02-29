<?php

namespace Database\Seeders;


use App\Models\Utente;
use App\Models\Utente_Ruolo;
use App\Models\UtenteStato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Utente::create([
            'nome' => 'AdminNome',
            'cognome' => 'AdminCognome',
            'email' => 'admin@email.com',
            'sesso' => 1,
            'codiceFiscale' => 'xxxxxxxxxxxx',
            'cittadinanza' => 'Italiana'
            
            
        ]);
        Utente::create([
            'nome' => 'UserNome',
            'cognome' => 'UserCognome',
            'email' => 'user@email.com',
            'Sesso' => 2,
            'codiceFiscale' => 'xxxxxxxxxxxx',
            'cittadinanza' => 'Italiana',
           
        ]);

        Utente_Ruolo::create([
            "idUtente"=>1,
            "idUtenteRuolo"=>1
        ]);
        Utente_Ruolo::create([
            "idUtente"=>2,
            "idUtenteRuolo"=>2
        ]);
        UtenteStato::create([
            "idUtente"=>1,
            "idStato"=>1
        ]);
        UtenteStato::create([
            "idUtente"=>2,
            "idStato"=>1
        ]);

    
    }
}
