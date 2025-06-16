<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\EventFootball;
use App\Models\Event;


class PredictionCloseController extends Controller
{


    public function show($id)
    {
        $event = Event::findOrFail($id);

        if ($event->type == 'football') {
            $eventFootball = EventFootball::where('id', $id)->first();
        } else {
            throw new \Exception("Invalid event type");
        }

        return view('predictionClose', ['eventFootball' => $eventFootball]);
    }


    public function update(Request $request, $id)
    {

        $dl = new DataLayer();
    
        switch ($request->input('type')) {
            case 'football':
                $dl->closeEventFootball(
                    $id,
                    $request->input('home_score'),
                    $request->input('away_score'),
                );
                break;
            default:
                throw new \Exception("Invalid event type");
        }

        return redirect()->route('controlPanel.index')->with('success', __('error.prediction-closed-successfully'));
    }
}
