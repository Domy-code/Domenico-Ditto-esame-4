<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieTv extends Model
{
    use HasFactory;
    protected $table = "serieTv";
    protected $primaryKey = "idSerieTv";
    
    protected $fillable = [
        "idSerieTv",
        "nome",
        "descrizione",
        "regista",
        "attori",
        "annoInizio",
        "annoFine",
       " idImmagine",
       "idFilmato"
    ];
    public function stagioni()
    {
        return $this->belongsToMany(Stagione::class, 'serieTv_stagioni', 'idSerieTv', 'idStagione');
    }
}
