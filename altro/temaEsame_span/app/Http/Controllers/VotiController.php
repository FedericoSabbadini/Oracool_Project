<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class VotiController extends Controller
{
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->storeVoto($request->all());

        return redirect()->route('home.index')->with('success', 'Voto registrato con successo!');
    }

    public function check(Request $request)
    {
        $dl = new DataLayer();
        $exists = $dl->checkVoto($request->all());

        if ($exists) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}
