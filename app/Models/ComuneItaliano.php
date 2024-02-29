<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComuneItaliano extends Model
{
    use HasFactory;
    protected $table ="comuniItaliani";
    protected $primaryKey="idComune";
    protected $fillable=[
        "nome",
        "regione",
        "provincia",
        "sigla",
        "codiceCatastale",
        "cap"
    ];
}
