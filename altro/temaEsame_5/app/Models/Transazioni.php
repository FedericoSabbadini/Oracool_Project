<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transazioni extends Model
{
    use HasFactory;

    protected $table = 'transazioni';

    protected $fillable = [
        'importo',
        'descrizione',
        'tipo',
        'data',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public $timestamps = true;

}
