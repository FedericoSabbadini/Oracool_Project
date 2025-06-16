<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PredictionFootball extends Model
{
    use HasFactory;

    protected $table = 'predictions_football';
    // protected primaryKey = 'id'
    protected $fillable = [
        'id',
        'predicted_1',
        'predicted_X',
        'predicted_2',
    ];
    public $timestamps = false; // Disabilita i timestamp automatici


    public function prediction()
    {
        return $this->belongsTo(Prediction::class);
    }
    
}
