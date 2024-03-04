<?php

use App\Http\Controllers\Api\AccediController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ComuneController;
use App\Http\Controllers\Api\CreditoController;
use App\Http\Controllers\Api\EpisodioController;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\IndirizzoController;
use App\Http\Controllers\Api\NazioneController;
use App\Http\Controllers\Api\RecapitoController;
use App\Http\Controllers\Api\RuoloController;
use App\Http\Controllers\Api\SerieTvController;
use App\Http\Controllers\Api\SerieTvStagioneEpisodiController;
use App\Http\Controllers\Api\StagioneController;
use App\Http\Controllers\Api\stagioneEpisodiController;
use App\Http\Controllers\Api\StatoController;
use App\Http\Controllers\Api\TipiRecapitoController;
use App\Http\Controllers\Api\TipoIndirizzoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\Autenticazione;
use App\Http\Resources\TipoIndirizzoCollection;
use App\Models\Nazione;
use App\Models\Recapito;
use App\Models\SerieTv;
use App\Models\TipoIndirizzo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/**ROUTES APERTE */
Route::get('/accedi/{utente}/{hash?}', [AccediController::class, 'show'])->name('accedi');
Route::get('/accedi', [AccediController::class, 'recuperoUser']);
Route::post('/registrazione', [UserController::class, 'store']);

/**ROUTES AUTENTICATE */

//ROUTES CON RUOLO ADMIN/USER
Route::group(['middleware' => ['Autenticazione', 'utenteRuolo:Admin,User']], function () {
    
    Route::get('film', [FilmController::class, 'index']);
    Route::get('serieTv', [SerieTvController::class, 'index']);
    Route::get('categoria', [CategoriaController::class, 'index']);
    Route::get('episodio', [EpisodioController::class, 'index']);
    Route::get('stagione', [StagioneController::class, 'index']);
    Route::get('serieTv/{id}/stagione/episodi',[SerieTvStagioneEpisodiController::class, 'index']);
    

    Route::get('film/{id}', [FilmController::class, 'show']);
    Route::get('serieTv/{id}', [SerieTvController::class, 'show']);
    Route::get('episodio/{id}', [EpisodioController::class, 'show']);
    Route::get('credito/{id}', [CreditoController::class, 'show']);
    Route::get('indirizzo/{id}', [IndirizzoController::class, 'show']);
    Route::get('utente/{id}', [UserController::class, 'show']);
    Route::get('stagione/{id}', [StagioneController::class, 'show']);
    Route::get('stagione/{id}/episodi',[stagioneEpisodiController::class, 'show']);
    Route::get('serieTv/{idSerieTv}/stagione/{idStagione}/episodi',[SerieTvStagioneEpisodiController::class, 'show']);
    Route::get('recapito/{id}', [RecapitoController::class, 'show']);

    Route::put('utente/{id}', [UserController::class, 'update']);
    Route::put('recapito/{id}', [RecapitoController::class, 'update']);
    Route::put('credito/{id}', [CreditoController::class, 'update']);
    Route::put('indirizzo/{id}', [IndirizzoController::class, 'update']);
    //ROUTES CON RUOLO ADMIN 
    Route::group(['middleware' => ['utenteRuolo:Admin']], function () {

        Route::get('tipoIndirizzo', [TipoIndirizzoController::class, 'index']);
        Route::get('tipoIndirizzo/{id}', [TipoIndirizzoController::class, 'show']);
        Route::delete('tipoIndirizzo/{id}', [TipoIndirizzoController::class, 'destroy']);
        Route::put('tipoIndirizzo/{id}', [TipoIndirizzoController::class, 'update']);
        

        Route::get('nazione', [NazioneController::class, 'index']);
        Route::get('nazione/{id}', [NazioneController::class, 'show']);
        Route::delete('nazione/{id}', [NazioneController::class, 'destroy']);
        Route::put('nazione/{id}', [NazioneController::class, 'update']);
        Route::post('nazione', [NazioneController::class, 'store']);

        Route::get('comune', [ComuneController::class, 'index']);
        Route::get('comune/{id}', [ComuneController::class, 'show']);
        Route::delete('comune/{id}', [ComuneController::class, 'destroy']);
        Route::put('comune/{id}', [ComuneController::class, 'update']);
        Route::post('comune', [ComuneController::class, 'store']);

        Route::get('utente', [UserController::class, 'index']);
        Route::delete('utente/{id}', [UserController::class, 'destroy']);

        Route::get('recapito', [RecapitoController::class, 'index']);
        Route::delete('recapito/{id}', [RecapitoController::class, 'destroy']);
        Route::post('recapito', [RecapitoController::class, 'store']);

        Route::get('tipiRecapito', [TipiRecapitoController::class, 'index']);
        Route::get('tipiRecapito/{id}', [TipiRecapitoController::class, 'show']);
        Route::delete('tipiRecapito/{id}', [TipiRecapitoController::class, 'destroy']);
        Route::put('tipiRecapito/{id}', [TipiRecapitoController::class, 'update']);
        Route::post('tipiRecapito', [TipiRecapitoController::class, 'store']);

        Route::get('ruolo', [RuoloController::class, 'index']);
        Route::get('ruolo/{id}', [RuoloController::class, 'show']);
        Route::delete('ruolo/{id}', [RuoloController::class, 'destroy']);
        Route::put('ruolo/{id}', [RuoloController::class, 'update']);
        Route::post('ruolo', [RuoloController::class, 'store']);

        Route::get('credito', [CreditoController::class, 'index']);
        Route::delete('credito/{id}', [CreditoController::class, 'destroy']);
        Route::post('credito', [CreditoController::class, 'store']);

        Route::get('indirizzo', [IndirizzoController::class, 'index']);
        Route::delete('indirizzo/{id}', [IndirizzoController::class, 'destroy']);
        Route::post('indirizzo', [IndirizzoController::class, 'store']);

        Route::delete('categoria/{id}', [CategoriaController::class, 'destroy']);
        Route::put('categoria/{id}', [CategoriaController::class, 'update']);
        Route::post('categoria', [CategoriaController::class, 'store']);

        Route::delete('serieTv/{id}', [SerieTvController::class, 'destroy']);
        Route::put('serieTv/{id}', [SerieTvController::class, 'update']);
        Route::post('serieTv', [SerieTvController::class, 'store']);         

        Route::delete('film/{id}', [FilmController::class, 'destroy']);
        Route::put('film/{id}', [FilmController::class, 'update']);
        Route::post('film', [FilmController::class, 'store']);

        Route::delete('episodio/{id}', [EpisodioController::class, 'destroy']);
        Route::put('episodio/{id}', [EpisodioController::class, 'update']);
        Route::post('episodio', [EpisodioController::class, 'store']);

        Route::delete('stagione/{id}', [StagioneController::class, 'destroy']);
        Route::put('stagione/{id}', [StagioneController::class, 'update']);
        Route::post('stagione', [StagioneController::class, 'store']);
        
    });
});
