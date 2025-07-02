<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Articolo;

class Autore extends Model
{
    use HasFactory;

    protected $table = 'autori';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'istituto',
    ];

    public function articoli()
    {
        return $this->belongsToMany(Articolo::class, 'articolo_autore', 'autore_id', 'articolo_id');
    }
}
