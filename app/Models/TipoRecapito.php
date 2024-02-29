<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRecapito extends Model
{
    use HasFactory;

    protected $table = "TipiRecapito";
    protected $primaryKey = "idTipoRecapito";
    
    protected $fillable = [
        "idTipoRecapito",
        "nome"
    ];
}
