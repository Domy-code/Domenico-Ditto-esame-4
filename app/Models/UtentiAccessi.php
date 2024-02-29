<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtentiAccessi extends Model
{
    use HasFactory;

    protected $table = "utentiAccessi";
    protected $fillable = [
        'idUtente',
        'autenticato',
        'ip'
    ];

    /**
     * Aggiungi accesso per l'idUtente
     * @param string $idUtente
     */

     public static function aggiungiAccesso($idUtente)
     {
        UtentiAccessi::eliminaTentativi($idUtente);
        return UtentiAccessi::nuovoRecord($idUtente,1);
     }

    /**
     * Aggiungi tentativo fallito per l'idUtente
     * 
     * @param string $idUtente
     */
    public static function aggiungiTentativoFallito($idUtente)
    {
        return UtentiAccessi::nuovoRecord($idUtente,0);
    }

    /**
     * Elimina i tentativi falliti 
     * @param string $idUtente
     */
public static function eliminaTentativi($idUtente)
{
    UtentiAccessi::where('idUtente', $idUtente)->where('autenticato', 0)->delete();
}




    /**
     * Conta quanti tentativi per l'idUtente sono registrati
     * 
     * @param string $idUtente
     * @param boolean $autenticato
     * @return \App\Models\Accesso
     */
    protected static function nuovoRecord($idUtente, $autenticato)
    {
        $tmp= UtentiAccessi::create([
            "idUtente"=> $idUtente,
            "autenticato" => $autenticato,
            "ip"=>request()->ip()
        ]);
        return $tmp;
    }
}
