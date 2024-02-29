<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Accesso extends Model
{
    use HasFactory;
    protected $table ="Accessi";
    protected $primaryKey="id";
    protected $fillable =[
        "idUtente",
        "idContatto",
        "autenticato",
        "ip"
    ];
/**
 * Aggiungi accesso per l'idUtente
 * @param string $idUtente
 */
public static function aggiungiAccesso($idUtente)
{
    Accesso::eliminaTentativi($idUtente);
    return Accesso::nuovoRecord($idUtente,1);

}
    /**
     * Aggiungi tentativo fallito per l'idUtente
     * 
     * @param string $idUtente
     */
    public static function aggiungiTentativoFallito($idUtente){
        return Accesso::nuovoRecord($idUtente,0);
    }

    /**
     * Conta quanti tentativi per l'idutente sono registrati
     * 
     * @param string $idUtente
     * @return integer
     */

     public static function contaTentativi($idUtente){
        $tmp=Accesso::where("idUtente", $idUtente)->where('autenticato',0)->count();
        return $tmp;
     }
     /**
      * Aggiungi un nuovo record
      * @param string $idUtente
      * @param boolean
      * @return \App\Models\Accesso
      */
   /**
     * Aggiunge un nuovo record
     * 
     * @param string $idUtente
     * @param boolean $autenticato
     * @return \App\Model\Accesso
     */
      protected static function nuovoRecord($idUtente,$autenticato)
      {
        $tmp=Accesso::create([
            "idUtente"=>$idUtente,
            "autenticato"=>$autenticato,
            "ip" => request()->ip()
        ]);
        return $tmp;
      }
 /**
     * Elimina i tentativi falliti 
     * @param string $idUtente
     */
      public static function eliminaTentativi($idUtente)
{
    Accesso::where('idUtente', $idUtente)->where('autenticato', 0)->delete();
}
}
