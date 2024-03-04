<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndirizzoStoreRequest;
use App\Http\Requests\IndirizzoUpdateRequest;
use App\Http\Resources\IndirizzoCollection;
use App\Http\Resources\IndirizzoResource;
use App\Models\Indirizzo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IndirizzoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $indirizzo = Indirizzo::all();
            return new IndirizzoCollection($indirizzo);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndirizzoStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $indirizzoValidato = $request->validated();
            // Creazione dell'elemento
            Indirizzo::create([
                'titolo' => $indirizzoValidato['titolo'],
                'descrizione' => $indirizzoValidato['descrizione'],
                'idCategoria' => $indirizzoValidato['idCategoria'],
                'durata' => $indirizzoValidato['durata'],
                'regista' => $indirizzoValidato['regista'],
                'attori' => $indirizzoValidato['attori'],
                'anno' => $indirizzoValidato['anno'],
                'idImmagine' => $indirizzoValidato['idImmagine'],
                'idFilmato' => $indirizzoValidato['idFilmato']
            ]);
            return response()->json(['message' => 'Elemento aggiunto con successo'], 201);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Gate::allows('leggere')) {
            try {
                $indirizzo = Indirizzo::findOrFail($id);
                return new IndirizzoResource($indirizzo);
            } catch (ModelNotFoundException $e) {
                abort(403, 'ERR NF_001');
            }
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndirizzoUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
            $token = $request->bearerToken();
            //decodifico il token
            $sessione = AccediController::verificaToken($token);
            //ricavo l'IdUtente dal token
            $idUtente = $sessione->data->idUtente;
            //ricavo l' IdRuolo dal token
            $idRuolo = $sessione->data->idRuolo;
            //Verifico se l' utente che effettua la richiesta sia il proprietario di quell' account o un admin
            if ($idUtente == $id || $idRuolo == 1) {

                $indirizzo = Indirizzo::findOrFail($id);

                //verifico i dati
                $dati = $request->validated();

                //riempio i dati
                $indirizzo->fill($dati);

                //Salvo
                $result = $indirizzo->save();

                // Verifico il risultato dell'operazione
                if ($result) {
                    // Se L'operazion e di salvataggio è avvenuta con successo
                    return $indirizzo;
                } else {
                    // L'operazione di salvataggio ha fallito
                    return response()->json(['error' => 'ERR SA_0001'], 404);
                }
            } else {
                abort(403, 'ERR NA_001');
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
            $indirizzo = Indirizzo::findOrFail($id);
            $indirizzo->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
