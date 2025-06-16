<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Event;
use App\Models\EventFootball;

class PredictionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response // 'scheduled', 'in_progress', 'ended', 'deleted'
    {

         $events = Event::all();
        foreach ($events as $event) {
            if ($event->start_time <= now() && $event->status === 'scheduled') {
                $event->status = 'in_progress';
                $event->save();
            }
            if ($event->start_time > now() && $event->status === 'in_progress') {
                $event->status = 'scheduled';
                $event->save();
            }
            }

        $eventsFootball = EventFootball::all();
        foreach ($eventsFootball as $eventFootball) {
            $eventFootball->status = Event::where('id', $eventFootball->id)->value('status');

            if ($eventFootball->status === 'in_progress') {
                $eventFootball->home_score = 0;
                $eventFootball->away_score = 0;
            } else if ($eventFootball->status === 'scheduled') {
                $eventFootball->home_score = null;
                $eventFootball->away_score = null;
            } 
            $eventFootball->save();
        }

        return $next($request);
    }
}
