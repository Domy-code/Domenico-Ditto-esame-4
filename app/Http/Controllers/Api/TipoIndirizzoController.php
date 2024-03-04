<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoIndirizzoStoreRequest;
use App\Http\Requests\TipoIndirizzoUpdateRequest;
use App\Http\Resources\TipoIndirizzoCollection;
use App\Http\Resources\TipoIndirizzoResource;
use App\Models\TipoIndirizzo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TipoIndirizzoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $tipoIndirizzo = TipoIndirizzo::all();
            return new TipoIndirizzoCollection($tipoIndirizzo);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoIndirizzoStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $tipoIndirizzoValidato = $request->validated();
            // Creazione dell'elemento
            TipoIndirizzo::create([
                'nome' => $tipoIndirizzoValidato['nome'],
              
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
            $tipoIndirizzo = TipoIndirizzo::findOrFail($id);
            return new TipoIndirizzoResource($tipoIndirizzo);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoIndirizzoUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          try{
            $tipoIndirizzo = TipoIndirizzo::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $tipoIndirizzo->fill($dati);

            //Salvo
            $result = $tipoIndirizzo->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $tipoIndirizzo;
            } else {
                // L'operazione di salvataggio ha fallito
                return response()->json(['error' => 'ERR SA_0001'], 404);
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
            $tipoIndirizzo = TipoIndirizzo::findOrFail($id);
            $tipoIndirizzo->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
