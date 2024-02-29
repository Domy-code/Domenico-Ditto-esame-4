<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruoli_Abilita extends Model
{
    use HasFactory;
    protected $table="ruoli_abilita";
    protected $primaryKey="id";
    protected $fillable=[
        "idUtenteRuolo",
        "idUtenteAbilita"
    ];
}
