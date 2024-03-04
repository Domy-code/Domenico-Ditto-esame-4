<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecapitoStoreRequest;
use App\Http\Requests\RecapitoUpdateRequest;
use App\Http\Resources\RecapitoCollection;
use App\Http\Resources\RecapitoResource;
use App\Models\Recapito;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RecapitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $recapito = Recapito::all();
            return new RecapitoCollection($recapito);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecapitoStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $recapitoValidato = $request->validated();
            // Creazione dell'elemento
            Recapito::create([
                'idUtente' => $recapitoValidato['idUtente'],
                'idTipoRecapito' => $recapitoValidato['idTipoRecapito'],
                'recapito' => $recapitoValidato['recapito']
            ]);
            return response()->json(['message' => 'Elemento aggiunto con successo'], 201);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (Gate::allows('leggere')) {
            try {
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
                    $recapito = Recapito::findOrFail($id);
                    return new RecapitoResource($recapito);
                } else {
                    abort(403, 'ERR NA_002');
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'ERR NF_0001'], 404);
            }
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecapitoUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
            try {
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
                    $recapito = Recapito::findOrFail($id);

                    //verifico i dati
                    $dati = $request->validated();

                    //riempio i dati
                    $recapito->fill($dati);

                    //Salvo
                    $result = $recapito->save();

                    // Verifico il risultato dell'operazione
                    if ($result) {
                        // Se L'operazione di salvataggio è avvenuta con successo
                        return $recapito;
                    } else {
                        // L'operazione di salvataggio ha fallito
                        return response()->json(['error' => 'ERR SA_0001'], 404);
                    }
                } else {
                    abort(403, 'ERR NA_001');
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'ERR NF_0001'], 404);
            }
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::allows('eliminare')) {
            $recapito = Recapito::findOrFail($id);
            $recapito->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
