<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EpisodioCollection;
use App\Http\Resources\EpisodioResource;
use App\Models\SerieTv;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SerieTvStagioneEpisodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            if (Gate::allows('leggere')) {
                // Trovo la serie TV desiderata utilizzando l'ID
                $serieTv = SerieTv::findOrFail($id);

                // Ottengo tutte le stagioni associate alla serie TV
                $stagioni = $serieTv->stagioni;

                // Per ogni stagione, ottengo tutti gli episodi associati
                $episodiPerStagione = [];
                foreach ($stagioni as $stagione) {
                    $episodiPerStagione[$stagione->idStagione] = $stagione->episodi;
                }

                return response()->json([
                    'serieTv' => $serieTv,
                    'stagioni' => $stagioni,
                    'episodiPerStagione' => $episodiPerStagione
                ]);
            } else {
                abort(403, 'ERR NA_001');
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'ERR NF_0001'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idSerieTv, $idStagione)
    {
        if (Gate::allows('leggere')) {
            try {
                // Trovo la serie TV 
                $serieTv = SerieTV::findOrFail($idSerieTv);

                // Trovo la stagione desiderata all'interno di quella serie TV
                $stagione = $serieTv->stagioni()->where('stagioni.idStagione', $idStagione)->firstOrFail();

                // Ottieni gli episodi relativi a quella stagione
                $episodi = $stagione->episodi;

                return new EpisodioCollection($episodi->makeHidden('pivot'));
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'ERR NF_0001'], 404);
            }
        } else {
            abort(403, 'ERR NA_001');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
