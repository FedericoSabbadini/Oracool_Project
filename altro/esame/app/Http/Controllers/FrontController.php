<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataLayer;


class FrontController extends Controller
{
    public function index()
    {
        return redirect()->route('login');
    } 
    public function home()
    {
        $dl = new DataLayer();
        $hotels = $dl->getHotel();

        return view('index' , [
            'hotels' => $hotels,
        ]);
    }
}