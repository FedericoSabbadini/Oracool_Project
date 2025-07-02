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
        $firstStudente = $dl->getFirstStudente();

        return view('index', [
            'firstStudente' => $firstStudente,
        ]);
    } 
}