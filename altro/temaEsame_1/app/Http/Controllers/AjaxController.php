<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class AjaxController extends Controller
{

    public function next(Request $request)
    {
        $dl = new DataLayer();
        $studentId = $request->input('id');
        $student = $dl->getStudentById($studentId);

        if ($request->input('which') == 0) {
            $next = $dl->getPrevStudent($student);
        } else {
            $next = $dl->getNextStudent($student);
        }
        
        return response()->json(['next' => $next]);
    }

    public function unique(Request $request)
    {
        $dl = new DataLayer();
        $unique = $dl->isUnique($request);

        return response()->json(['unique' => $unique]);
    }
}
