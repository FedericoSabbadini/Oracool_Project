<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Autore;

class Articolo extends Model
{
    use HasFactory;
    
    protected $table = 'articoli';

    protected $fillable = [
        'titolo',
    ];

    public function autori()
    {
        return $this->belongsToMany(Autore::class, 'articolo_autore', 'articolo_id', 'autore_id');
    }
}
