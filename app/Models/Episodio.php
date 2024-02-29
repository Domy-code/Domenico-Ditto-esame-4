<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    use HasFactory;
    protected $table ="episodi";
    protected $primaryKey="idEpisodio";
    protected $fillable=[
        "titolo",
        "descrizione",
        "numeroEpisodio",
        "durata",
        "attori",
        "anno",
        "idImmagine",
        "idFilmato"
    ];
   
}
