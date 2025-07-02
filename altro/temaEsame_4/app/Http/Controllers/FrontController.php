<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataLayer;


class FrontController extends Controller
{
    public function index()
    {
        return view('index', [
            'teams' => [],
            'btn' => 0,
        ]);
    } 

    public function create()
    {
        $dataLayer = new DataLayer();
        $teams = $dataLayer->getPunteggiMedi();

        return response()->json([
            'teams' => $teams,
        ]);
    }

    public function store(Request $request)
    {
        $dataLayer = new DataLayer();
        $teams = $dataLayer->randomInitialize();

        return view ('index', [
            'teams' => $teams,
            'btn' => 1,
        ]);
    }
    public function delete(Request $request)
    {
        $dataLayer = new DataLayer();
        $teams = $dataLayer->deleteAll();

        return view ('index', [
            'teams' => $teams,
            'btn' => 2,
        ]);
    }
    

}