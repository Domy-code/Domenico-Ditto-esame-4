<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtenteStato extends Model
{
    use HasFactory;
    protected $table = "utenti_stati";
    protected $primaryKey = "id";
    protected $fillable = [
        "idUtente",
        "idStato"
    ];
}
