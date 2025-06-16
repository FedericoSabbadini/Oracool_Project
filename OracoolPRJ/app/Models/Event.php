<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    // protected primaryKey = 'id'
    protected $fillable = [
        'start_time',
        'type',
        'status',   
        'liveBlock',
    ];
        
    protected $casts = [
        'start_time' => 'datetime',
    ];
        

        public function predictions()
        {
            return $this->hasMany(Prediction::class, 'event_id','id');
        }
        public function eventFootball()
        {
            return $this->hasOne(EventFootball::class);
        }
}
