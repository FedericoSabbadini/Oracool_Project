<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Log;


class FrontController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $activities = $dl->getAllActivities();

        return view('index',  ['activities' => $activities]);
    }

    public function create() {
        return view('addActivity');
    }

    public function store(Request $request) {
        $dl = new DataLayer();
        $dl->createActivity($request);

        return redirect()->route('home.index')->with('success', 'Activity created successfully!');
    }
    public function ajaxActivities(Request $request)
    {
        $id = $request->input('id');
        $dl = new DataLayer();
        $activities = $dl->setCheckedById($id);
        Log::info('Activities after toggle: ', $activities->toArray());
        return response()->json($activities);
    }

}