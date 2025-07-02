<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lucido extends Model
{
    protected $table = 'lucidi';

    protected $fillable = [
        'titolo',
        'link',
        'commento',
        'isVisible',
    ];

}
