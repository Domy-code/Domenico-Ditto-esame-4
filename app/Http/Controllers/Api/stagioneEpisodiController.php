<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EpisodioCollection;
use App\Http\Resources\EpisodioResource;
use App\Http\Resources\StagioneCollection;
use App\Http\Resources\StagioniEpisodiCollection;
use App\Models\Stagione;
use App\Models\StagioniEpisodi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class stagioneEpisodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function show(string $id)
    {
        if (Gate::allows('leggere')) {
            try {
                $stagione = Stagione::findOrFail($id);
                $episodi = $stagione->episodi->map(function ($episodio) {
                    return $episodio->makeHidden('pivot');
                });

                return new EpisodioCollection($episodi);
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
