<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FrontController extends Controller
{
    public function index()
    {



        if (Auth::check() && Auth::user()->admin) 
        {
            return redirect()->route('controlPanel.index');
        } 
        else 
        {
            return view('index');
        }
    }

public function setIsAdmin(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Utente non autenticato');
    }

    $adminValue = $request->input('admin');

    if (!in_array($adminValue, ['0', '1', 0, 1], true)) {
        return response()->json(['error' => 'Valore admin non valido'], 422);
    }

    $user->admin = $adminValue;
    $user->save();

    return response()->json(['success' => true]);
}


        
}