<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "films";
    protected $primaryKey = "idFilm";
    
    protected $fillable = [

        "idFilm",
        "idCategoria",
        "titolo",
        "descrizione",
        "durata",
        "regista",
        "attori",
        "anno",
        "idImmagine",
        "idFilmato"

    ];
}