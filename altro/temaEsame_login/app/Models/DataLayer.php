<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lucido;


class DataLayer extends Model
{

    public function getLucidi() {
        return Lucido::orderBy('created_at', 'asc')->where('isVisible', 1)
            ->get();
    }

    public function storeLucido($request) {

        $link= $request->input('titolo') . '.pdf';
        $file = $request->file('filePDF');
        $file->move(public_path('uploads'), $link);

        $lucido = new Lucido();
        $lucido->titolo = $request->input('titolo');
        $lucido->commento = $request->input('commento');
        $lucido->isVisible = $request->input('isVisible');
        $lucido->percorso = $link;
        $lucido->save();
    }

}