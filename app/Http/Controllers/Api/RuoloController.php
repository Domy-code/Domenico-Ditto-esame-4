<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuoloStoreRequest;
use App\Http\Requests\RuoloUpdateRequest;
use App\Http\Resources\RuoloCollection;
use App\Http\Resources\RuoloResource;
use App\Models\Ruolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RuoloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $ruolo = Ruolo::all();
            return new RuoloCollection($ruolo);
        } else {
            abort(403, 'Operazione non permessa');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RuoloStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $reuoloValidato = $request->validated();
            // Creazione dell'elemento
            Ruolo::create([
                'nome' => $reuoloValidato['nome'],
              
            ]);
            return response()->json(['message' => 'Elemento aggiunto con successo'], 201);
        } else {
            return response()->json(['message' => 'Non autorizzato'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Gate::allows('leggere')) {
            $ruolo = Ruolo::find($id);
            return new RuoloResource($ruolo);
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RuoloUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $ruolo = Ruolo::find($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $ruolo->fill($dati);

            //Salvo
            $result = $ruolo->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $ruolo;
            } else {
                // L'operazione di salvataggio ha fallito
                return response()->json(['error' => 'Operazione non effettuata'], 400);
            }
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::allows('eliminare')) {
            $ruolo = Ruolo::find($id);
            $ruolo->delete();

            return response()->noContent();
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }
}
