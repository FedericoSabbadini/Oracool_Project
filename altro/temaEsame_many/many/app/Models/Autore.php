<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Articolo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autore extends Model
{
    use HasFactory;
    
    protected $table = 'autori';

    protected $fillable = [
        'nome',
        'cognome',
        'email',
        'istituto',
    ];

    public function articoli()
    {
        return $this->belongsToMany(Articolo::class, 'articolo_autore', 'autore_id', 'articolo_id');
    }
}
