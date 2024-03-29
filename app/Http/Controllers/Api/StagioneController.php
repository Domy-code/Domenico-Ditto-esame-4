<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StagioneStoreRequest;
use App\Http\Requests\StagioneUpdateRequest;
use App\Http\Resources\StagioneCollection;
use App\Http\Resources\StagioneResource;
use App\Models\SerieTv_Stagioni;
use App\Models\Stagione;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StagioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('leggere')) {
            $stagione = Stagione::all();
            return new StagioneCollection($stagione);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StagioneStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $stagioneValidata = $request->validated();
            // Creazione dell'elemento
            $stagione = Stagione::create([
                'nome' => $stagioneValidata['nome']
            ]);
            $idStagione = $stagione->idStagione;
            if (isset($idStagione)) {
                SerieTv_Stagioni::create([
                    'idSerieTv' => $stagioneValidata['idSerieTv'],
                    'idStagione' => $idStagione
                ]);
            }
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
                $stagione = Stagione::findOrFail($id);
                return new StagioneResource($stagione);
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
    public function update(StagioneUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {

            $stagione = Stagione::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $stagione->fill($dati);

            //Salvo
            $result = $stagione->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $stagione;
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
        //
    }
}
