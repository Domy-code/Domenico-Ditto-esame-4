<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatoStoreRequest;
use App\Http\Requests\StatoUpdateRequest;
use App\Http\Resources\StatoCollection;
use App\Models\Stato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $comune = Stato::all();
            return new StatoCollection($comune);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatoStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $statoValidato = $request->validated();
            // Creazione dell'elemento
            Stato::create([
                'nome' => $statoValidato['nome'],
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
            $stato = Stato::findOrFail($id);
            return new Stato($stato);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatoUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $stato = Stato::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $stato->fill($dati);

            //Salvo
            $result = $stato->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $stato;
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
            $stato = Stato::findOrFail($id);
            $stato->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
