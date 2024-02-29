<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SerieTvStoreRequest;
use App\Http\Requests\SerieTvUpdateRequest;
use App\Http\Resources\SerieTvCollection;
use App\Http\Resources\SerieTvResource;
use App\Models\SerieTv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SerieTvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $serieTv = SerieTv::all();
            return new SerieTvCollection($serieTv);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SerieTvStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $serieTvValidata = $request->validated();
            // Creazione dell'elemento
            SerieTv::create([
                
                'nome' => $serieTvValidata['nome'],
                'descrizione' => $serieTvValidata['descrizione'],
                'idCategoria' => $serieTvValidata['idCategoria'],
                'totaleStagioni' => $serieTvValidata['totaleStagioni'],
                'numeroEpisodi' => $serieTvValidata['numeroEpisodi'],
                'regista' => $serieTvValidata['regista'],
                'attori' => $serieTvValidata['attori'],
                'annoInizio' => $serieTvValidata['annoInizio'],
                'annoFine' => $serieTvValidata['annoFine'],
                'idImmagine' => $serieTvValidata['idImmagine'],
                'idFilmato' => $serieTvValidata['idFilmato']

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
            $serieTv = SerieTv::find($id);
            return new SerieTvResource($serieTv);
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SerieTvUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $serieTv = SerieTv::find($id);

            //verifico i dati
            $dati = $serieTv->validated();

            //riempio i dati
            $serieTv->fill($dati);

            //Salvo
            $result = $serieTv->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $serieTv;
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
            $categoria = SerieTv::find($id);
            $categoria->delete();

            return response()->noContent();
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }
}
