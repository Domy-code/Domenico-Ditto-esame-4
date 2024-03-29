<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $categoria = Categoria::all();
            return new CategoriaCollection($categoria);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            try {
                $categoriaValidata = $request->validated();
                // Creazione dell'elemento
                Categoria::create([
                    'nome' => $categoriaValidata['nome']
                ]);
                return response()->json(['message' => 'Elemento aggiunto con successo'], 201);
            } catch (ModelNotFoundException $e) {
                abort(403, 'ERR NF_001');
            }
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
                $categoria = Categoria::findOrFail($id);
                return new CategoriaResource($categoria);
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
    public function update(CategoriaUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {

            $categoria = Categoria::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $categoria->fill($dati);

            //Salvo
            $result = $categoria->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $categoria;
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
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
