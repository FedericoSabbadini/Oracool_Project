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
        $articoli = $dl->getArticoli();

        return view('index', ['articoli' => $articoli]);
    } 

    public function create($id)
    {
        $dl = new DataLayer();
        $articolo = $dl->getArticoloById($id);
        $autori = $articolo->autori()->get();
        return response()->json([
            'autori' => $autori
        ]);
    }
}