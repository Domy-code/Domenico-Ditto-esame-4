<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoIndirizzoStoreRequest;
use App\Http\Requests\TipoIndirizzoUpdateRequest;
use App\Http\Resources\TipoIndirizzoCollection;
use App\Http\Resources\TipoIndirizzoResource;
use App\Models\TipoIndirizzo;
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
            abort(403, 'Operazione non permessa');
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
            return response()->json(['message' => 'Non autorizzato'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Gate::allows('leggere')) {
            $tipoIndirizzo = TipoIndirizzo::find($id);
            return new TipoIndirizzoResource($tipoIndirizzo);
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoIndirizzoUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $tipoIndirizzo = TipoIndirizzo::find($id);

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
            $tipoIndirizzo = TipoIndirizzo::find($id);
            $tipoIndirizzo->delete();

            return response()->noContent();
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }
}
