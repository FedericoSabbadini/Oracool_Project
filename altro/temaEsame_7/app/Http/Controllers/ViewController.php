<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class ViewController extends Controller
{
    public function create()
    {
        $dl = new DataLayer();
        $lucidi = $dl->getAllLucidi();
        return view('view', ['lucidi' => $lucidi]);
    }

}
