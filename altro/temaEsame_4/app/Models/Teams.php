<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'nome'; 
    public $incrementing = false;
    protected $keyType = 'string'; // Specify the key type as string

    protected $fillable = [
        'nome',
        'partiteGiocate',
        'partiteVinte',
        'partitePareggiate',
        'partitePerse',
        'punteggio',
    ];

}
