<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UtenteAuth extends Model
{
    use HasFactory;
    protected $table = "auths";
    protected $primaryKey = "idAuth";
    protected $fillable = [
        "idUtente",
        "user",
        "sfida",
        "inizioSfida",
        "secretJWT",
        "scadenzaSfida"
    ];
    public static function esisteUtenteValidoPerLogin($user)
    {   //Verifico se l' utente auths.user è uguale all' utente che sto passando
        //Ricavo l' idUtente dell'utente 
        $idUtente = DB::table('auths')->where('user', $user)->value('idUtente');
        
        //controllo se è  uguale a quello della tabella utenti
        $utenteCount = DB::table('utenti')->where('idUtente', $idUtente)->count();

       return ($utenteCount > 0) ? true : false;
    }
}
