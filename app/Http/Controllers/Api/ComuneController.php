<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComuniStoreRequest;
use App\Http\Requests\ComuniUpdateRequest;
use App\Http\Resources\ComuneCollection;
use App\Http\Resources\ComuneResource;
use App\Models\ComuneItaliano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ComuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $comune = ComuneItaliano::all();
            return new ComuneCollection($comune);
        } else {
           abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComuniStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $comuneValidato = $request->validated();
            // Creazione dell'elemento
            ComuneItaliano::create([
                'nome' => $comuneValidato['nome'],
                'regione' => $comuneValidato['regione'],
                'provincia' => $comuneValidato['provincia'],
                'sigla' => $comuneValidato['sigla'],
                'codiceCatastale' => $comuneValidato['codiceCatastale'],
                'cap' => $comuneValidato['cap']
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
            $comune = ComuneItaliano::findOrFail($id);
            return new ComuneResource($comune);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComuniUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $comune = ComuneItaliano::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $comune->fill($dati);

            //Salvo
            $result = $comune->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $comune;
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
            $comune = ComuneItaliano::findOrFail($id);
            $comune->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
