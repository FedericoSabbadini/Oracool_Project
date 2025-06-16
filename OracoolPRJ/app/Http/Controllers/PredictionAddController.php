<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Carbon\Carbon;


class PredictionAddController extends Controller
{

    public function create()
    {
        $clubData = include resource_path('data/clubData.php');

        return view('predictionAdd', [
        'teams' => $clubData['teams'],
        'countries' => $clubData['countries'],
        'cities' => $clubData['cities'],
        'stadiums' => $clubData['stadiums'],
        'competitions' => $clubData['competitions'],
    ]);;
    }

    public function store(Request $request)
    {

        $dl = new DataLayer();
        $start_time = Carbon::createFromFormat('d-m-Y, H:i', $request->input('start_time'));
    
        switch ($request->input('type')) {
            case 'football':
                $dl->addEventFootball(
                    $start_time,
                    $request->input('home_team'),
                    $request->input('away_team'),
                    $request->input('competition'),
                    $request->input('season'),
                    $request->input('stadium'),
                    $request->input('city'),
                    $request->input('country'),
                    $request->input('quote_1'),
                    $request->input('quote_X'),
                    $request->input('quote_2')
                );
                break;
            default:
                throw new \Exception("Invalid event type");
        }

        return redirect()->route('controlPanel.index')->with('success', __('error.prediction-added-successfully'));
    }
}
