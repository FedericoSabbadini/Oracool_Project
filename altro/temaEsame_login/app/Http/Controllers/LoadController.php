<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class LoadController extends Controller
{
    public function create()
    {
        return view('load');
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->storeLucido($request);

        return redirect()->route('view.create')->with('success', 'File uploaded');
    }
}
