<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilita extends Model
{
    use HasFactory;
    protected $table = "Abilita";
    protected $primaryKey = "idAbilita";
    protected $fillable = [
        "nome",
        "sku"
    ];
}
