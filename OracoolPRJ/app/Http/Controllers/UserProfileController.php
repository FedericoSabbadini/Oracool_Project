<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Prediction;
use App\Models\Event;
use App\Models\PredictionFootball;
use App\Models\EventFootball;
use App\Models\User;

class UserProfileController extends Controller
{
    public function index()
    {
        $user= Auth::user();;
        $predictions = Prediction::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $predictionsFootball = PredictionFootball::whereIn('id', $predictions->pluck('id'))->get();

        $events = Event::whereIn('id', $predictions->pluck('event_id'))->get();

        $eventsFootball = EventFootball::whereIn('id', $predictions->pluck('event_id'))->get();

        return view('userProfile', [
            'userPredictions' => $predictions,
            'userPredictionsFootball' => $predictionsFootball,
            'userEvents' => $events,
            'userEventsFootball' => $eventsFootball,
            'user' => $user,

        ]);
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        $predictions = Prediction::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $predictionsFootball = PredictionFootball::whereIn('id', $predictions->pluck('id'))->get();

        $events = Event::whereIn('id', $predictions->pluck('event_id'))->get();

        $eventsFootball = EventFootball::whereIn('id', $predictions->pluck('event_id'))->get();

        return view('userProfile', [
            'userPredictions' => $predictions,
            'userPredictionsFootball' => $predictionsFootball,
            'userEvents' => $events,
            'userEventsFootball' => $eventsFootball,
            'user' => $user,
        ]);
    }


}
