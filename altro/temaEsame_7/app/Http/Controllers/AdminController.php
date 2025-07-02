<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class AdminController extends Controller
{

    public function create()
    {
        return view('admin');
    }
    public function store(Request $request)
    {
        $link = $request->input('titolo') . '.pdf';
        $request['link'] = $link;

        $dl = new DataLayer();
        $dl->storeLucido($request);
        $file = $request->file('filePDF');
        if ($file) {
            $file->move(public_path('uploads'),  $request['link']); 
        }

        $lucidi  = $dl->getAllLucidi();
        return view('view', ['lucidi' => $lucidi]);
    }
}
