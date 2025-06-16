<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventFootball;
use App\Models\DataLayer;
use Carbon\Carbon;
use App\Models\Event;

class PredictionEditController extends Controller
{

    public function show($id)
    {
        $event = Event::findOrFail($id);

        if ($event->type == 'football') {
            $eventFootball = EventFootball::where('id', $id)->first();
        } else {
            throw new \Exception("Invalid event type");
        }

        return view('predictionEdit', ['eventFootball' => $eventFootball]);
    }

    public function edit(Request $request, $id)
    {
        $dl = new DataLayer();
        $start_time = Carbon::createFromFormat('d-m-Y, H:i', $request->input('start_time'));

        switch ($request->input('type')) {
            case 'football':
                $dl->editEventFootball(
                    $id, 
                    $request
                );
                break;
            default:
                throw new \Exception("Invalid event type");
        }

        return redirect()->route('controlPanel.createEdit')->with('success', __('error.prediction-edited-successfully'));

    }
}
