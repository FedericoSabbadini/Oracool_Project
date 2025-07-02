<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class ArticoloController extends Controller
{
    public function showAutori(Request $request)
    {

        $articoloId = $request->input('articolo_id');
        $dl = new DataLayer();
        $autori = $dl->getAutoriByArticolo($articoloId);

        return response()->json([
            'autori' => $autori,
        ]);
    }
}
