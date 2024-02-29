<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class film_has_contatti extends Model
{
    use HasFactory;
    protected $table="film_has_contatti";

    protected $fillable =[
        "idFilm",
        "contatti_idContatto"
    ];
}
