<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventFootball extends Model
{
    protected $table = 'events_football';
    // protected primaryKey = 'id'
    protected $fillable = [
        'id', // Foreign key to Event
        'home_team',
        'away_team',
        'home_score',
        'away_score',
        'start_time',
        'competition',
        'season',
        'stadium',
        'city',
        'country',
        'status',
        'liveBlock',
        'quote_1',
        'quote_X',
        'quote_2',
    ];
    protected $casts = [
        'start_time' => 'datetime',
    ];
    public $timestamps = false; // Disabilita i timestamp automatici

    public function event()
    {
        return $this->belongsTo(Event::class, 'id', 'id');
    }
}
