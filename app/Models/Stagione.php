<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagione extends Model
{
    use HasFactory;
    protected $table = "stagioni";
    protected $primaryKey = "idStagione";
    protected $fillable = [
        "nome"
    ];
    public function episodi()
    {
        return $this->belongsToMany(Episodio::class, 'stagioni_episodi', 'idStagione', 'idEpisodio');
    }
}
