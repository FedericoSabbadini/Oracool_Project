<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\EventFootball;

/**
 * ControlPanelController handles the control panel functionalities.
 * It provides methods to display the control panel, create or edit predictions,
 * and close predictions for football events.
 */
class ControlPanelController extends Controller
{
    /**
     * Display the control panel view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('controlPanel');
    }

    /**
     * Create a new prediction.
     *
     * @return \Illuminate\View\View
     */
    public function createEdit()
    {
        $dl = new DataLayer();
        $eventsFootball = $dl->getEventFootballEditing();

        if($eventsFootball->isEmpty()){
            return redirect()->route('controlPanel.index')->with('error', 'No events available for editing.');
        } else {
            return view('predictionList', ['eventsFootball' => $eventsFootball, 'action' => 'edit']);
        }
    }

    /**
     * Close predictions for football events.
     *
     * @return \Illuminate\View\View
     */
    public function createClose()
    {
        $dl = new DataLayer();
        $eventsFootball = $dl->getEventFootballClosing();

        if($eventsFootball->isEmpty()){
            return redirect()->route('controlPanel.index')->with('error', 'No events available for closing.');
        } else {
            return view('predictionList', ['eventsFootball' => $eventsFootball, 'action' => 'close']);

        }
    }
}