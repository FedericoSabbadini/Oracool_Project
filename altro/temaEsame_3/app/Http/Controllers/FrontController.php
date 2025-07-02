<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataLayer;


class FrontController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $voti = $dl->getVoti();

        return view('index', [
            'voti' => $voti,
        ]);
    } 
    
    public function store(Request $request) {

        $dl = new DataLayer();
        $dl->storeVoto($request);

        return redirect()->route('home.index');
    }

    public function ajax (Request $request) {
        $dl = new DataLayer();
        $unique = $dl->isUnique($request);

        if ($unique) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}