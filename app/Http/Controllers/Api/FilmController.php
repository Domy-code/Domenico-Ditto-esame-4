<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilmStoreRequest;
use App\Http\Requests\FilmUpdateRequest;
use App\Http\Resources\FilmCollection;
use App\Http\Resources\FilmResource;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Gate::allows('leggere')) {
            $film = Film::all();
            return new FilmCollection($film);
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmStoreRequest $request)
    {
        if (Gate::allows('aggiungere')) {
            $filmValidato = $request->validated();
            // Creazione dell'elemento
            Film::create([
                'titolo' => $filmValidato['titolo'],
                'descrizione' => $filmValidato['descrizione'],
                'idCategoria' => $filmValidato['idCategoria'],
                'durata' => $filmValidato['durata'],
                'regista' => $filmValidato['regista'],
                'attori' => $filmValidato['attori'],
                'anno' => $filmValidato['anno'],
                'idImmagine' => $filmValidato['idImmagine'],
                'idFilmato' => $filmValidato['idFilmato']
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
            $film = Film::find($id);
            return new FilmResource($film);
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmUpdateRequest $request, string $id)
    {
        if (Gate::allows('aggiornare')) {
          
            $film = Film::find($id);

            //verifico i dati
            $dati = $request->validated();

            //riempio i dati
            $film->fill($dati);

            //Salvo
            $result = $film->save();

            // Verifico il risultato dell'operazione
            if ($result) {
                // Se L'operazione di salvataggio è avvenuta con successo
                return $film;
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
            $film = film::find($id);
            $film->delete();

            return response()->noContent();
        } else {
            return response()->json(['error' => 'Non autorizzato'], 401);
        }
    }
}
