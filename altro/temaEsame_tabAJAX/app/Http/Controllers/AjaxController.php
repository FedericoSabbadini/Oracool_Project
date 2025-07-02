<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function next(Request $request)
    {
        $currentId = $request->input('id');
        $dl = new DataLayer();
        $nextStudente = $dl->getNextStudente($currentId);

        if (!$nextStudente) {
            $nextStudente = $dl->getStudenteById($currentId);
        }

        return response()->json([
            'id' => $nextStudente->id,
            'data_appello' => $nextStudente->data_appello->format('Y-m-d'),
            'numero_matricola' => $nextStudente->numero_matricola,
            'cognome' => $nextStudente->cognome,
            'nome' => $nextStudente->nome,
            'voto' => $nextStudente->voto,
        ]);

    }

    public function previous(Request $request)
    {
        $currentId = $request->input('id');
        $dl = new DataLayer();
        $previousStudente = $dl->getPreviousStudente($currentId);

        if (!$previousStudente) {
            $previousStudente = $dl->getStudenteById($currentId);
        }

        return response()->json([
            'id' => $previousStudente->id,
            'data_appello' => $previousStudente->data_appello->format('Y-m-d'),
            'numero_matricola' => $previousStudente->numero_matricola,
            'cognome' => $previousStudente->cognome,
            'nome' => $previousStudente->nome,
            'voto' => $previousStudente->voto,
        ]);
    }

    public function store(Request $request)
    {

        $dl = new DataLayer();
        $dl->storeStudente($request->all());

        return redirect ()->route('home.index')->with('success', 'Studente salvato con successo!');
    }
}
