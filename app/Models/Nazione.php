<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nazione extends Model
{
    use HasFactory;
    protected $table ="nazioni";
    protected $primaryKey="IdNazione";
    protected $fillable=[
        "idNazione",
        "nome",
        "continente",
        "iso2",
        "iso3",
        "prefissoTelefonico"
    ];
}
