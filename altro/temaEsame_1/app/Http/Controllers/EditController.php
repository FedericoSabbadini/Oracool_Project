<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class EditController extends Controller
{
    /**
     * Show the edit form for a student.
     */
    public function edit(Request $request)
    {
        $dl = new DataLayer();

        if ($request->has('id')) {
            $student = $dl->getStudentById($request->input('id'));
        } else {
            $student = $dl->getFirstStudent();
        }
        
        return view('edit', [
            'student' => $student,
        ]);
    }

    
    public function update(Request $request)
    {
        $dl = new DataLayer();
        $dl->updateStudent($request);

        return redirect()->route('home.index')->with('success', 'Studente modificato con successo!');
    }
}
