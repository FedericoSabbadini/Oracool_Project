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
}