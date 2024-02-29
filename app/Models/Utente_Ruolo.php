<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utente_Ruolo extends Model
{
    use HasFactory;
    protected $table = "utenti_ruoli";
    protected $primaryKey = "id";
    protected $fillable = [
        "idUtente",
        "idUtenteRuolo"
    ];
}
