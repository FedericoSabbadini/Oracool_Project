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
        $numVoti = $dl->getNumVoti();
        $mediaVoti = $dl->getMediaVoti();
        $suffVoti = $dl->getSuffVoti();
        $maxVoto = $dl->getMaxVoto();
        $minVoto = $dl->getMinVoto();

        return view('index', [
            'numVoti' => $numVoti,
            'mediaVoti' => $mediaVoti,
            'suffVoti' => $suffVoti,
            'maxVoto' => $maxVoto,
            'minVoto' => $minVoto,
        ]);
    } 
}