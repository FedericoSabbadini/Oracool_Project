<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\EventFootball;
use App\Models\Event;

/**
 * PredictionCloseController handles the closing of predictions for events.
 * It retrieves the event details and allows updating the scores for football events.
 */
class PredictionCloseController extends Controller
{

    /**
     * Show the form for closing a prediction for a specific event.
     *
     * @param int $id The ID of the event.
     * @return \Illuminate\View\View
     */
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

    /**
     * Update the prediction for a specific event.
     *
     * @param Request $request The request containing the updated scores.
     * @param int $id The ID of the event.
     * @return \Illuminate\Http\RedirectResponse
     */
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