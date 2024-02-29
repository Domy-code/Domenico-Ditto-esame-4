<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sessione extends Model
{
    use HasFactory;
    protected $table="sessioni";
    protected $primaryKey="idSessione";
    protected $fillable = [
        "idUtente",
        "token",
        "inizioSessione"
    ];
    /**
     * Aggiorna la sessione per l' utente ed il token passato
     * 
     * @param integer $idUtente
     * @param string $token
     */
    public static function aggiornaSessione($idUtente, $tk)
    {
        $where = ["idUtente" => $idUtente, "token"=>$tk];
        $arr=["inizioSessione"=>time()];
        DB::table("sessioni")->updateOrInsert($where,$arr);
    }
    /**
     * Elimina la sessione per il Utente passato
     * 
     * @param integer $idUtente
     */
    public static function eliminaSessione($idUtente)
    {
        DB::table("sessioni")->where("idUtente",$idUtente)->delete();
    }
    /**
     * Dati sessione
     * 
     * @param string $token
     * @return \App\Models\Sessione
     */

     public static function datiSessione($token)
     {
        if (Sessione::esisteSessione($token)){
            return Sessione::where("token", $token)->get()->first();
        }else{
        
        }
     }

     /**
      * Controlla se esiste la sessione col token passato
      * @param string $token
      * @return boolean
      */
      public static function esisteSessione($token)
      {
        return DB::table("sessioni")->where("token", $token)->exists();
      }

}
