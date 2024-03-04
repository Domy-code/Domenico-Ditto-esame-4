<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Http\Requests\UtentiStoreRequest;
use App\Http\Requests\UtentiUpdateRequest;
use App\Http\Resources\UtenteCollection;
use App\Http\Resources\UtenteResource;
use App\Models\Credito;
use App\Models\Indirizzo;
use App\Models\Password;
use App\Models\User;
use App\Models\Utente;
use App\Models\Utente_Ruolo;
use App\Models\UtenteAuth;
use App\Models\UtenteStato;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('leggere')) {
            $utente = Utente::all();
            return new UtenteCollection($utente);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UtentiStoreRequest $request)
    {
        $utenteValidato = $request->validated();
        // Creazione dell'utente
        $utente = Utente::create([
            'nome' => $utenteValidato['nome'],
            'cognome' => $utenteValidato['cognome'],
            'email' => $utenteValidato['email'],
            'sesso' => $utenteValidato['sesso'],
            'cittadinanza' => $utenteValidato['cittadinanza'],
            'codiceFiscale' => $utenteValidato['codiceFiscale']
        ]);
        $idUtente = $utente->idUtente;

        $sale = hash('sha512', trim(Str::random(200)));
        Password::create([
            'idUtente' => $idUtente,
            'psw' => hash('sha512', trim(request('psw'))),
            'sale' => $sale
        ]);
        UtenteAuth::create([
            'idUtente' => $idUtente,
            'user' => hash('sha512', trim(Str::random(200)))
        ]);
        Utente_Ruolo::create([
            'idUtente' => $idUtente,
            'idUtenteRuolo' => 2
        ]);
        Credito::create([
            'idUtente' => $idUtente,
            'credito' => 0
        ]);

        Indirizzo::create([
            "idUtente" => $idUtente,
            "idTipoIndirizzo" => 2,
            "idNazione" => $utenteValidato['idNazione'],
            "idComune" => $utenteValidato['idComune'],
            "cap" => $utenteValidato['cap'],
            "indirizzo" => $utenteValidato['indirizzo'],
            "civico" => $utenteValidato['civico'],
            "località" => $utenteValidato['località']
        ]);
        UtenteStato::create([
            "idUtente" => $idUtente,
            "idStato" => 1
        ]);

        return response()->json(['message' => 'Utente creato con successo'], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (Gate::allows('leggere')) {
            // Estraggo il token JWT 
            $token = $request->bearerToken();
            //decodifico il token
            $sessione = AccediController::verificaToken($token);
            //ricavo l'IdUtente dal token
            $idUtente = $sessione->data->idUtente;
            //ricavo l' IdRuolo dal token
            $idRuolo = $sessione->data->idRuolo;
            //Verifico se l' utente che effettua la richiesta sia il proprietario di quell' account o un admin
            if ($idUtente == $id || $idRuolo == 1) {
                try {
                    $utente = Utente::findOrFail($id);
                    return new UtenteResource($utente);
                } catch (ModelNotFoundException $e) {
                    abort(403, 'ERR NF_001');
                }
            } else {
                abort(403, 'ERR NF_0001');
            }
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UtentiUpdateRequest $request, $id)
    {
        if (Gate::allows('aggiornare')) {

            // Estraggo il token JWT 
            $token = $request->bearerToken();
            //decodifico il token
            $sessione = AccediController::verificaToken($token);
            //ricavo l'IdUtente dal token
            $idUtente = $sessione->data->idUtente;
            //ricavo l' IdRuolo dal token
            $idRuolo = $sessione->data->idRuolo;
            //Verifico se l' utente che effettua la richiesta sia il proprietario di quell' account o un admin
            if ($idUtente == $id || $idRuolo == 1) {
                $utente = Utente::findOrFail($id);

                //verifico i dati
                $dati = $request->validated();

                //riempio i dati
                $utente->fill($dati);

                //Salvo
                $result = $utente->save();

                // Verifico il risultato dell'operazione
                if ($result) {
                    // Se L'operazione di salvataggio è avvenuta con successo
                    return $utente;
                } else {
                    // L'operazione di salvataggio ha fallito
                    return response()->json(['error' => 'ERR SA_0001'], 404);
                }
            } else {
                abort(403, 'ERR NA_001');
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        if (Gate::allows('eliminare')) {
            $utente = Utente::findOrFail($id);
            $utente->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
