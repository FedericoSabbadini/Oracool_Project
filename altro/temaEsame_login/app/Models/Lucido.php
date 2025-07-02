<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lucido extends Model
{

    protected $fillable = [
        'titolo',
        'commento',
        'percorso',
        'isVisible'
    ];
}