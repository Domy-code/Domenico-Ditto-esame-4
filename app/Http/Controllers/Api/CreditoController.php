<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditoStoreRequest;
use App\Http\Requests\CreditoUpdateRequest;
use App\Http\Resources\CreditoCollection;
use App\Http\Resources\CreditoResource;
use App\Models\Credito;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            
                $credito = Credito::all();
                return new CreditoCollection($credito);
        
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditoStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $creditoValidato = $request->validated();
            // Creazione dell'elemento
            Credito::create([
                'idUtente' => $creditoValidato['idUtente'],
                'credito' => $creditoValidato['credito']
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
                    $credito = Credito::findOrFail($id);
                    return new CreditoResource($credito);
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
    public function update(CreditoUpdateRequest $request, string $id)
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
                    // Trova un'istanza del modello Credito in base all'idUtente
                    $credito = Credito::where('idUtente', $idUtente)->first();
                    //verifico i dati
                    $dati = $request->validated();

                    //riempio i dati
                    $credito->fill($dati);

                    //Salvo
                    $result = $credito->save();

                    // Verifico il risultato dell'operazione
                    if ($result) {
                        // Se L'operazione di salvataggio è avvenuta con successo
                        return new CreditoResource($credito);
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
            $credito = Credito::findOrFail($id);
            $credito->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
