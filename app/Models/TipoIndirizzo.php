<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIndirizzo extends Model
{
    use HasFactory;
    protected $table = "TipoIndirizzi";
    protected $primaryKey = "idTipoIndirizzo";
    
    protected $fillable = [
        "idTipoIndirizzo",
        "nome"
    ];
}
