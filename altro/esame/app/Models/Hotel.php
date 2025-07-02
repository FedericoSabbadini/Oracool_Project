<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;


    protected $fillable = [
        'descrizione',
        'nome',
        'localita',
        'immagine',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'hotel_id', 'id');
    }
}
