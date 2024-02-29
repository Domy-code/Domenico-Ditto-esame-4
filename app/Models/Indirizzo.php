<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indirizzo extends Model
{
    use HasFactory;

    protected $table = "Indirizzi";
    protected $primaryKey = "idIndirizzo";
    
    protected $fillable = [
        "idUtente",
        "idIndirizzo",
        "idTipoIndirizzo",
        "idContatto",
        "idNazione",
        "idComune",
        "cap",
        "indirizzo",
        "civico",
        "località",
        "lat",
        "lng",
    ];
}
