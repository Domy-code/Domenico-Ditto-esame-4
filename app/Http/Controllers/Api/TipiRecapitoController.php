<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\tipoRecapitoStoreRequest;
use App\Http\Requests\TipoRecapitoUpdateRequest;
use App\Http\Resources\TipoRecapitoCollection;
use App\Http\Resources\TipoRecapitoResource;
use App\Models\TipoRecapito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TipiRecapitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $tipoRecapito = TipoRecapito::all();
            return new TipoRecapitoCollection($tipoRecapito);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(tipoRecapitoStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $tipoRecapitoValidato = $request->validated();
            // Creazione dell'elemento
            TipoRecapito::create([
                'nome' => $tipoRecapitoValidato['nome'],
              
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
            $tipoRecapito = TipoRecapito::findOrFail($id);
            return new TipoRecapitoResource($tipoRecapito);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoRecapitoUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $tipoRecapito = TipoRecapito::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $tipoRecapito->fill($dati);

            //Salvo
            $result = $tipoRecapito->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $tipoRecapito;
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
            $tipoRecapito = TipoRecapito::findOrFail($id);
            $tipoRecapito->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
