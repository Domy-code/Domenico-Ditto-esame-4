<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;
    protected $table="crediti";
    protected $primaryKey="idCredito";
    protected $fillable=[
        "idUtente",
        "credito"
    ];
}
