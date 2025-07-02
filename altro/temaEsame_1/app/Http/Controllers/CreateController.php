<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class CreateController extends Controller
{
    public function create(Request $request)
    {

        return view('create');
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addStudent($request);

        return redirect()->route('home.index')->with('success', 'Studente aggiunto con successo!');
    }
}
