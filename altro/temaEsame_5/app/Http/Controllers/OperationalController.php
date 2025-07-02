<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class OperationalController extends Controller
{
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->createTransaction($request);

       return redirect()->route('home.index')
            ->with('message', 'Transaction created successfully!');
    }

    public function create()
    {
        return view('createTransaction');
    }
}
