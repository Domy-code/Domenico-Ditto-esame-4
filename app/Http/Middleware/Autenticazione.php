<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\AccediController;
use App\Models\Ruolo;
use App\Models\Utente;
use App\Models\UtenteAuth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Autenticazione
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        $token = $_SERVER['HTTP_AUTHORIZATION'];
        $token = trim(str_replace("Bearer", "", $token));
        $payload = AccediController::verificaToken($token);
        if ($payload != null) {
            //Estraggo l' utente dal database utilizzando l' id contenuto nel payload
            $utente = Utente::where("idUtente", $payload->data->idUtente)->firstOrFail();
            //Verifico che lo stato dell' utente sia 1 quindi che sia un utente attivo
            if ($payload->data->idStato == 1) {
                //Effettuo il login
                Auth::login($utente);
                $request->merge(['utentiRuoli' => $utente->ruoli->pluck('nome')->toArray()]);
          return $next($request);
            } else {
                abort(403, "Utente non attivo");
            }
        } else {
            abort(403, 'TK_001');
        }
    }
}
