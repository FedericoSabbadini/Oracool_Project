<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\EventFootball;

class ControlPanelController extends Controller
{
    public function index()
    {
        return view('controlPanel');
    }

    public function createEdit()
    {
        $eventsFootball = EventFootball::where('status','!=', 'ended')->where('status','!=', 'deleted')->get();

        if($eventsFootball->isEmpty()){
            return redirect()->route('controlPanel.index')->with('error', 'No events available for editing.');
        } else {
            return view('predictionList', ['eventsFootball' => $eventsFootball, 'action' => 'edit']);
        }
    }
    public function createClose()
    {
    
        $eventsFootball = EventFootball::where('status', 'in_progress')->get();

        if($eventsFootball->isEmpty()){
            return redirect()->route('controlPanel.index')->with('error', 'No events available for closing.');
        } else {
            return view('predictionList', ['eventsFootball' => $eventsFootball, 'action' => 'close']);

        }
    
    }
}
