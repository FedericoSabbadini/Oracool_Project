<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voti extends Model
{
    protected $table = 'voti';
    use HasFactory;

    protected $fillable = [
        'nome',
        'cognome',
        'numero_matricola',
        'voto',
        'data_esame',
        'commenti',
    ];

    public $timestamps = true;
}
