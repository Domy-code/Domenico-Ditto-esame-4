<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recapito extends Model
{
    use HasFactory;
    protected $table = "recapiti";
    protected $primaryKey = "idRecapito";
    
    protected $fillable = [
        "idRecapito",
        "idUtente",
        "idTipoRecapito",
        "recapito"
    ];
}
