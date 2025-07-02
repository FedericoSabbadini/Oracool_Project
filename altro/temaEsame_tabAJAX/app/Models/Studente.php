<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studente extends Model
{
    use HasFactory;
    
    protected $table = 'studenti';

    protected $fillable = [
        'nome',
        'cognome',
        'data_appello',
        'numero_matricola',
        'voto', 
    ];

    protected $casts = [
        'data_appello' => 'date',
    ];

    public $timestamps = true;
}
