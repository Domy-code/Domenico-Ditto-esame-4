<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruolo extends Model
{
    use HasFactory;
    protected $table = 'ruoli';
    protected $primaryKey="idRuolo";
    protected $fillable=[
        'nome'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

     public function abilita()
     {
        return $this->belongsToMany(Abilita::class, 'ruoli_abilita', 'idUtenteRuolo','idUtenteAbilita');
     }

}
