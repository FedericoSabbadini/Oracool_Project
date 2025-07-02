<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exams extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'nome',
        'cognome',
        'voto',
        'lode',
        'data_esame',
        'commenti',
        'numMatricola',
    ];

    protected $casts = [
        'data_esame' => 'date',
        'lode' => 'boolean',
    ];
}
