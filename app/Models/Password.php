<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "password";
    protected $primaryKey = "idPassword";
    protected $fillable = [
        "idUtente",
        "idPassword",
        "idContatto",
        "psw",
        "sale"
    ];
    protected $hidden=[
        "psw"
    ];

    //Recupera l' ultima password utilizzata dall' utente
    public static function passwordAttuale($idUtente)
    {
        $record = Password::where("idUtente",$idUtente)->orderBy('idPassword','desc')->first();
        return $record;
    }
}
