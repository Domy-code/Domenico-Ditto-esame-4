<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Accesso;
use App\Models\Configurazione;
use App\Models\Password;
use App\Models\Sessione;
use App\Models\Utente;
use App\Models\UtenteAuth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccediController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Punto di ingrresso del login
     * 
     * @param string $utente
     * @param string $hash
     * @return .\App\Helpers\rispostaCustom
     */
    public function show($utente, $hash = null)
    {
        if ($hash == null) {
            return AccediController::controlloUtente($utente);
        } else {
            return AccediController::controlloPassword($utente, $hash);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function recuperoUser(Request $request)
    {
        // Estraggo l'email dalla richiesta
        $email = $request->input('email');

        //Estraggo l' istanza dell' utente
        $utente = Utente::where('email', $email)->first();

        // Se esiste un utente associato all'email 
        if ($utente) {
            // Se esiste nel database

            //Trovo l' idUtente relativo all'email
            $idUtente = $utente->idUtente;
            //Uso l' idUtente per ricavare il valore del campo user della tabella auths
            $user = DB::table('utenti')->join('auths', 'utenti.idUtente', '=', 'auths.idUtente')->where('utenti.idUtente', $idUtente)->value('auths.user');
            // Costruisco la query string con l'user come parametro
            $queryString = http_build_query(['user' => $user]);
            // Redirect alla rotta con la query string
            return redirect()->route('accedi', ['utente' => $user])->withQueryString($queryString);
        } else {
            // Se l'email non esiste nel database
            abort(404, 'ERR RU001');
        }
    }
    //controllo se l' utente è valido
    protected static function controlloUtente($utente)
    {
        $sale = hash("sha512", trim(Str::random(200)));

        if (UtenteAuth::esisteUtenteValidoPerLogin($utente)) {
            //se esiste
            //Prendo l' utente dal database e lo assegno alla variabile $auth
            $auth = UtenteAuth::where('user', $utente)->first();
            //creo l' hash per il campo secretJWT
            $auth->secretJWT = hash('sha512', trim(Str::random(200)));
            //inserisco il time attuale nel campo inizioSfida
            $auth->inizioSfida = time();
            //salvo
            $auth->save();
            //Prelevo il record dell' utente dalla tabella delle password
            $recordPassword = Password::passwordAttuale($auth->idUtente);
            //inserisco nel campo sale del record il valore contenuto nella variabile $sale
            $recordPassword->sale = $sale;
            //salvo
            $recordPassword->save();
            //Cifro la password 
            $password = hash('sha512', trim(request('password')));
            //Creo l hash
            $hashClient = AppHelper::nascondiPassword($password, $sale);
        } 

        // Costruisco la query string con l'hashClient come parametro
        $queryString = http_build_query(['utente' => $auth->user,'hash' => $hashClient]);
       
        // Redirect alla rotta con la query string
       return redirect()->route('accedi', ['utente' => $auth->user,'hash' => $hashClient])->withQueryString($queryString);
     
        //ritorno alla funzione show 
    }

    /**
     * Punto di ingresso del login
     * @param string $utente
     * @param string $hash
     * @return  .\App\Helpers\rispostaCustom
     */

    protected static function controlloPassword($utente, $hashClient)
    {
        //Controllo se l' utente è valido
        if (UtenteAuth::esisteUtenteValidoPerLogin($utente)) {
            //Se esiste
            //Prendo l' utente dal database e lo assegno alla variabile $auth
            $auth = UtenteAuth::where('user', $utente)->first();
            //Assegno alla variabile $secretJWT il valore contenuto nel campo secretJWT della tabella
            $secretJWT = $auth->secretJWT;
            //Assegno alla variabile $inizioSfida il valore contenuto nel campo inizioSfida della tabella
            $inizioSfida = $auth->inizioSfida;
            //Prelevo il valore realitvo alla durata della sfida contenuto nella tabella Configurazione e lo assegno alla variabile $durataSfida
            $durataSfida = Configurazione::leggiValore('durataSfida');
            //Prelevo il valore di maxLoginErrati contenuto nella tabella Configurazione e lo assegno alla variabile $maxTentativi
            $maxTentativi = Configurazione::leggiValore('maxLoginFalliti');
            $scadenzaSfida = $inizioSfida + $durataSfida;
            //verifico se l' orario attuale è minore rispetto alla $scadenzaSfida
            if (time() < $scadenzaSfida) {
                //se è minore
                $tentativi = Accesso::contaTentativi($auth->idUtente);

                if ($tentativi < $maxTentativi) {
                    //proseguo
                    //recupero il record della password relativo all' idUtente contenuto nella tabella password
                    $recordPassword = Password::passwordAttuale($auth->idUtente);
                    //Assegno alla variabile $password il dato appena estratto dal database
                    $password = $recordPassword->psw;
                    //Assegno il valore del campo sale contenuto nella tabella password
                    $sale = $recordPassword->sale;
                    //Cifro la password
                    $passwordNascostaDB = AppHelper::nascondiPassword($password, $sale);

                    //se l hash dell utente (inviato nell query) è uguale all hash della password
                    if ($hashClient == $passwordNascostaDB) {
                        //login corretto quindi creo il token
                        $token = AppHelper::creaTokenSessione($auth->idUtente, $secretJWT);
                        //Elimino i tentativi di accesso
                        Accesso::eliminaTentativi($auth->idUtente);
                        //Aggiungo l' accesso alla tabella
                        Accesso::aggiungiAccesso($auth->idUtente);
                        //Elimino la sessione
                        Sessione::eliminaSessione($auth->idUtente);
                        Sessione::aggiornaSessione($auth->idUtente, $token);
                        //Inserisco all' interno della variabile un array associativo col token
                        $dati = array('tk' => $token);
                        //ritorno il token al client
                    
                        return AppHelper::rispostaCustom($dati);
                    } else {
                        Accesso::aggiungiTentativoFallito($auth->idUtente);
                        abort(403, 'ERR L004');
                    }
                } else {
                    abort(403, 'ERR L003');
                }
            } else {
                Accesso::aggiungiTentativoFallito($auth->idUtente);
                abort(403, 'ERR L002');
            }
        } else {
            //Se l' utente non è valido
            abort(403, 'ERR L001');
        }
    }

    /**
     * Verifica il token ad ogni chiamata
     * @param string $token
     * @return object
     */

    public static function verificaToken($token)
    {

        $rit = null;
        //Estraggo i dati della sessione
        $sessione = Sessione::datiSessione($token);
        // se la sessione non è nulla
        if ($sessione != null) {
            //estraggo il valore di inizio sessione
            $inizioSessione = $sessione->inizioSessione;
            //associo alla variabile il valore contenuto nel database
            $durataSessione = Configurazione::leggiValore("durataSessione");
            $scadenzaSessione = $inizioSessione + $durataSessione;
            //Controllo che la sessione non sia scaduta
            if (time() < $scadenzaSessione) {
                //Se non è scaduta ricavo l' idUtente della sessione
                $auth = UtenteAuth::where('idUtente', $sessione->idUtente)->first();
                //Controllo se l' id è diverso da null
                if ($auth != null) {
                    //Se è diverso associo alla variabile il valore contenuto nel database
                    $secretJWT = $auth->secretJWT;
                    //Valido il token e lo associo alla variabile
                    $payload = AppHelper::validaToken($token, $secretJWT, $sessione);
                    if ($payload != null) {
                        $rit = $payload;
                    } else {
                        abort(403, 'TK_0006');
                    }
                } else {
                    abort(403, 'TK_0005');
                }
            } else {

                abort(403, 'TK_0004');
            }
        } else {
            abort(403, 'TK_0003');
        }
        //se il token viene validato correttamente lo invio alla prossima funzione
        return $rit;
    }
}
