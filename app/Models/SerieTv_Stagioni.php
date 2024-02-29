<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieTv_Stagioni extends Model
{
    use HasFactory;

    protected $table = 'serietv_stagioni';
    protected $primaryKey = "id";
    protected $fillable = [
        "idSerieTv",
        "idStagione"
    ];
}
