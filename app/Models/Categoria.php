<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
    protected $primaryKey = "idCategoria";
    protected $table = "categorie";
    protected $fillable = [
        "idCategoria",
        "nome"
    ];
}
