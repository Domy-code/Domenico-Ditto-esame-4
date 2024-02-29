<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Utente extends User implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $primaryKey = "idUtente";
    protected $table = "utenti";
    protected $fillable = [
        'nome',
        'cognome',
        'email',
        'sesso',
        'codiceFiscale',
        'cittadinanza'
    ];

    use Notifiable;
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function ruoli()
    {

        return $this->belongsToMany(Ruolo::class, 'utenti_ruoli', 'idUtente', 'idUtenteRuolo');
    }
}
