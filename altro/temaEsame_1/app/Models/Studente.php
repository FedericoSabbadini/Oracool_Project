<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studente extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'dataAppello',
        'numMatricola',
        'cognome',
        'nome',
        'voto',
    ];

    protected $casts = [
        'dataAppello' => 'date',
    ];
    

}
