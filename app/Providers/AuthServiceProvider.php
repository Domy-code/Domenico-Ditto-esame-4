<?php

namespace App\Providers;

use App\Models\Abilita;
use App\Models\Ruolo;
use App\Models\Utente;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
      
        if (app()->environment()!== 'testing'){
            //Gate basato su un ruolo
            //Richoamo il model dei ruoli e li ciclo con each()
            Ruolo::all()->each(
                //Applico una funzione applicando ogni ruolo
                function (Ruolo $ruolo){
                    //Definisco il gate col nome del singolo ruolo
                    Gate::define($ruolo->nome, function (Utente $utente) use($ruolo){
                        //Se l' utente dei ruoli contiene nel nome il $ruolo->nome
                        return $utente->ruoli->contains('nome',$ruolo->nome);
                    });
                }
            );

            //Gate basati su multiple abilita
            //Faccio una collection delle abilità e le ciclo
            Abilita::all()->each(function(Abilita $abilita){
                //per ogni abilita creo il nome prelevandolo dal campo sku
                Gate::define($abilita->sku, function (Utente $utente)use($abilita){
                    //Setto a false la variabile check
                    $check=false;
                    //Ciclo l' utente per i ruoli
                    foreach ($utente->ruoli as $item){
                        //Se nella collection abilita è contenuto il valore di sku
                        if ($item->abilita->contains('sku',$abilita->sku)){
                            //Porto check a true
                            $check=true;
                            break;
                        }
                    }
                    return $check;
                });
            });
        }

    }
}
