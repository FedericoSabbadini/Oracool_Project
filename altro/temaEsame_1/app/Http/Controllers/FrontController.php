<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        $dl = new DataLayer();
        $students = $dl->getStudents();

        return view('index', [
            'students' => $students,
        ]);
    }
}
