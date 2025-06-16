<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;


class PredictionController extends Controller
{
    public function create()
    {
        $dl = new DataLayer();
        $eventsFootball = $dl->getTodayEventsFootballPredictions();


        $pred=0;
        foreach ($eventsFootball as $eventFootball) {
            if ($eventFootball->status === 'scheduled') {
                $pred=1;
            }
        }

        if ($eventsFootball->isEmpty()) {
            return view('prediction', ['eventsFootball' => $eventsFootball, 'error' => __('error.no-predictions-today'),]);
            
        } elseif ($pred == 0) {
            return view('prediction', ['eventsFootball' => $eventsFootball, 'error' => __('error.no-predictions-today'),]);

        } else {
            return view('prediction', ['eventsFootball' => $eventsFootball,]);
        }
    }

    public function store(Request $request)
    {

        $dl = new DataLayer();
        $eventsFootball = $dl->getTodayEventsFootball();
        

        foreach ($eventsFootball as $eventFootball) {
            if ($request->input($eventFootball->id)) {
                $dl->storeTodayEventsFootballPredictions($eventFootball->id, $request->input($eventFootball->id));
            }
        }

        return redirect()->route('prediction.create')->with('success', __('error.prediction-registered-successfully'));
    }
}
