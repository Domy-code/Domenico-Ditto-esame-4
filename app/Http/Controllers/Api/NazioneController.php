<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NazioniStoreRequest;
use App\Http\Requests\NazioniUpdateRequest;
use App\Http\Resources\NazioneCollection;
use App\Http\Resources\NazioneResource;
use App\Models\Nazione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NazioneController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $nazione = Nazione::all();
            return new NazioneCollection($nazione);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NazioniStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $nazioneValidata = $request->validated();
            // Creazione dell'elemento
            Nazione::create([
                'nome' => $nazioneValidata['nome'],
                'continente' => $nazioneValidata['continente'],
                'iso2' => $nazioneValidata['iso2'],
                'iso3' => $nazioneValidata['iso3'],
                'prefissoTelefonico' => $nazioneValidata['prefissoTelefonico']
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
            $nazione = Nazione::findOrFail($id);
            return new NazioneResource($nazione);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NazioniUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $nazione = Nazione::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $nazione->fill($dati);

            //Salvo
            $result = $nazione->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $nazione;
            } else {
                // L'operazione di salvataggio ha fallito
                return response()->json(['error' => 'ERR SA_0001'], 404);
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
            $nazione = Nazione::findOrFail($id);
            $nazione->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
