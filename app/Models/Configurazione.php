<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configurazione extends Model
{
    use HasFactory;
    protected $table ='configurazioni';
    protected $fillable = [
        'nome',
        'valore'
    ];

    protected static function leggiValore($campo){
        $valore=Configurazione::where('nome', $campo)->value('valore');
  
        return $valore;
    }
}
