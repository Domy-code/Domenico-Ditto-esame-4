<?php

namespace App\Helpers;

use App\Models\Utente;
use Tymon\JWTAuth\Contracts\Providers\JWT as ProvidersJWT;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\DB;

class AppHelper
{
    /**
     * Controlla se esiste l' utente passato
     * 
     * @param boolean $sucesso TRUE se la richiesta è andata a buon fine
     * @param integer $codice STATUS CODE della richiesta
     * @param array $dati Dati richiesti
     * @param string $messaggio
     * @param array $errori
     * @return array
     */
    public static function rispostaCustom($dati, $msg = null, $err = null)
    {
        $response = array();
        $response['data'] = $dati;
        if ($msg != null) $response["message"] = $msg;
        if ($err != null) $response["error"] = $err;
        return $response;
    }

    /**
     * Unisce password e sale e fa l' hash
     * @param string $password
     * @param string $sale
     * @return string
     */
    public static function nascondiPassword($psw, $sale)
    {
        return hash('sha512', $sale . $psw);
    }


    /**
     * Creo il token di sessione
     * 
     * @param integer $idUtente
     * @param string $secretJWT chiave di cifratura
     * @param integer|null $usaDa unixtime abilitazione uso token
     * @param integer|null $scade unixtime scadenza uso token
     * @return string|null Token JWT o null in caso di errore
     */
    public static function creaTokenSessione($idUtente, $secretJWT, $usaDa = null, $scade = null)
    {
        //imposto la durata del token
        $maxTime = 15 * 24 * 60 * 60; // il token scade sempre dopo max 15 gg

        // recupero i dati dell'utente dalla tabella Utenti
        $recordUtente = Utente::where("idUtente", $idUtente)->first();
        if (!$recordUtente) {
            // Utente non trovato
            return null;
        }

        // Creo la variabile $time che servirà per eseguire dei calcoli successivamente
        $t = time();
        $nbf = ($usaDa == null) ? $t : $usaDa;
        $exp = ($scade == null) ? $nbf + $maxTime : $scade;
        // Ricavo il valore del campo ruoli
        $idRuolo = DB::table('utenti')->join('utenti_ruoli', 'utenti.idUtente', '=', 'utenti_ruoli.idUtente')->where('utenti.idUtente', $idUtente)->value('utenti_ruoli.idUtenteRuolo');
        //Ricavo il valore del campo stato
        $idStato = DB::table('utenti')->join('utenti_stati', 'utenti.idUtente', '=', 'utenti_stati.idUtente')->where('utenti.idUtente', $idUtente)->value('utenti_stati.idStato');
    
        // Creo un JSON con tutti i dati che andranno contenuti nel token
        $arr = [
            "iss" => 'https://www.codex.it',
            "aud" => null,
            "iat" => $t,
            "nbf" => $nbf,
            "exp" => $exp,
            "data" => [
                "idUtente" => $idUtente,
                "idStato" => $idStato,
                "idRuolo" => $idRuolo,
                //  "abilita" => $abilita,
                "nome" => trim($recordUtente->nome . " " . $recordUtente->cognome)
            ]
        ];
        $keyId = "my_key_id_123";
        // Cifro il token
        $token = JWT::encode($arr, $secretJWT, 'HS256', $keyId);
        return $token;
    }

    /**
     * 
     * @param  string $token
     * @param string $messaggio
     * @param array $errori
     * @return object
     */
    public static function validaToken($token, $secretJWT, $sessione)
    {
        $rit = null;
        //Decodifico il token
        $payload = JWT::decode($token, new Key($secretJWT, 'HS256'));
        //Controllo se l'inizio sessione del database è minore o uguale all'inizio sessione del token
        if ($payload->iat <= $sessione->inizioSessione) {
            if ($payload->data->idUtente == $sessione->idUtente) {
                $rit = $payload;
            }
        }
        return $rit;
    }
}
