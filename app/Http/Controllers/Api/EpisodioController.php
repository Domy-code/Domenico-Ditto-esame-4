<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpisodioStoreRequest;
use App\Http\Requests\EpisodioUpdateRequest;
use App\Http\Resources\EpisodioCollection;
use App\Http\Resources\EpisodioResource;
use App\Models\Episodio;
use App\Models\StagioniEpisodi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            try{
            $episodio = Episodio::all();
            return new EpisodioCollection($episodio);
            }catch (ModelNotFoundException $e) {
                abort(403, 'ERR NF_001');
            }
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EpisodioStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $episodioValidato = $request->validated();
            // Creazione dell'elemento

           $episodio = Episodio::create([
                'titolo' => $episodioValidato['titolo'],
                'descrizione' => $episodioValidato['descrizione'],
                'numeroEpisodio' => $episodioValidato['numeroEpisodio'],
                'durata' => $episodioValidato['durata'],
                'anno' => $episodioValidato['anno'],
                'attori' => $episodioValidato['attori'],
                'idImmagine' => $episodioValidato['idImmagine'],
                'idFilmato' => $episodioValidato['idFilmato']
            ]);
            $idEpisodio = $episodio->idEpisodio;

            StagioniEpisodi::create([
                'idStagione' => $episodioValidato['idStagione'],
                'idEpisodio'=>$idEpisodio
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
            $episodio = Episodio::findOrFail($id);
            return new EpisodioResource($episodio);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EpisodioUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $episodio = Episodio::findOrFail($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $episodio->fill($dati);

            //Salvo
            $result = $episodio->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $episodio;
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
            $episodio = Episodio::findOrFail($id);
            $episodio->delete();

            return response()->noContent();
        } else {
            abort(403, 'ERR NA_001');
        }
    }
}
