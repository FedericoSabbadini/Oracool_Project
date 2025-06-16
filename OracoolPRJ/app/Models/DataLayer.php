<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\EventFootball;
use App\Models\Prediction;
use App\Models\PredictionFootball;
use Illuminate\Support\Facades\Auth;

class DataLayer extends Model
{

    private function getTodayEvents(){

        $events = Event::whereDate('start_time', now()->toDateString())
            ->orderBy('start_time','asc')
            ->get();

        return $events; 
    }

    public function getTodayEventsFootball(){

        $events = $this->getTodayEvents()
            ->where('type', 'football')
            ->pluck('id');;

        
        $eventsFootball = EventFootball::whereIn('id', $events)
            ->orderBy('start_time', 'asc')
            ->get();
    

        return $eventsFootball; 
    }

    public function getTodayEventsFootballPredictions(){

        $eventsFootball = $this->getTodayEventsFootball();

        if (Auth::check()) {
            $userId = Auth::user()->id;

            foreach ($eventsFootball as $event) {
                $prediction = Prediction::where('user_id', $userId)
                    ->where('event_id', $event->id)
                    ->first(); // Restituisce null se non esiste

                if ($prediction) {
                    $predictionFootball = PredictionFootball::where('id', $prediction->id)
                        ->first(); // Restituisce null se non esiste

                    if ($predictionFootball) {
                        $event->predicted_1 = $predictionFootball->predicted_1;
                        $event->predicted_X = $predictionFootball->predicted_X;
                        $event->predicted_2 = $predictionFootball->predicted_2;
                    }
                }
            }
        }

        return $eventsFootball; 
    }

    public function storeTodayEventsFootballPredictions($id, $result){

        $prediction = Prediction::updateOrCreate(
            [
                'event_id' => $id,
                'user_id' => Auth::user()->id,
            ]
        );

        $predictionFootball = PredictionFootball::updateOrCreate(
            ['id' => $prediction->id], // Solo chiavi di ricerca, altrimenti cerca un record con tutte le condizioni
            [
                'predicted_1' => $result === '1',
                'predicted_2' => $result === '2',
                'predicted_X' => $result === 'X',
            ]
        );
    }

    public function addEventFootball($start_time, $home_team, $away_team, $competition, $season, $stadium, $city, $country, $quote_1, $quote_X, $quote_2){

        $event = Event::create([
            'status' => 'scheduled',
            'type' => 'football',
            'start_time' => $start_time,
        ]);

        EventFootball::create([
            'id' => $event->id,
            'start_time' => $event->start_time,
            'competition' => $competition,
            'home_team' => $home_team,
            'away_team' => $away_team,
            'season' => $season,
            'stadium' => $stadium,
            'city' => $city,
            'country' => $country,
            'status' => 'scheduled',
            'quote_1' => $quote_1,
            'quote_X' => $quote_X,
            'quote_2' => $quote_2,
        ]);
    }

    public function closeEventFootball($id, $home_score, $away_score){

        $eventFootball = EventFootball::findOrFail($id);
        $eventFootball->home_score = $home_score;
        $eventFootball->away_score = $away_score;
        $eventFootball->status = 'ended';
        $eventFootball->save();
        

        $event = Event::findOrFail($id);
        $event->status = 'ended';
        $event->save();

        $this->closePredictionFootball($event);
    }

    private function closePredictionFootball($event)
    {
        $predictions = Prediction::where('event_id', $event->id)->get();
        $eventFootball = EventFootball::find($event->id);


        foreach ($predictions as $prediction) {

            $predictionFootball = PredictionFootball::where('id', $prediction->id)->first();

            $actualResult = null;
            $points = -1;

            if ($eventFootball->home_score > $eventFootball->away_score) {
                $actualResult = '1';
            } elseif ($eventFootball->home_score < $eventFootball->away_score) {
                $actualResult = '2';
            } elseif ($eventFootball->home_score == $eventFootball->away_score) {
                $actualResult = 'X';
            }

            if ($actualResult === '1' && $predictionFootball->predicted_1) {
                $prediction->value = true;
                $points = $eventFootball->quote_1;
            } elseif ($actualResult === '2' && $predictionFootball->predicted_2) {
                $prediction->value = true;
                $points = $eventFootball->quote_2;
            } elseif ($actualResult === 'X' && $predictionFootball->predicted_X) {
                $prediction->value = true;
                $points = $eventFootball->quote_X;
            } else {
                $prediction->value = false;
            }

            if ($prediction->value) {
                User::find($prediction->user_id)?->increment('points', $points);
            }
            $prediction->save();
        }
    }

   public function editEventFootball($id, $request)
    {
        $eventFootball = EventFootball::findOrFail($id);

        $updateData = $request->only([
            'home_score', 'away_score', 'competition', 'season', 'start_time',
            'stadium', 'city', 'country', 'quote_1', 'quote_X', 'quote_2'
        ]);
        $updateData = array_filter($updateData, function($value) {
            return $value !== null;
        });


        if (!empty($updateData)) {
            $eventFootball->update($updateData);
        }
        if ($request->has('start_time') && $request->input('start_time') !== null) {
            Event::find($id)->update([
                'start_time' => $request->input('start_time'),
            ]);
        }
    }
}