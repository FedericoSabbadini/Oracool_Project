<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Autore;
use App\Models\Articolo;


class DataLayer extends Model
{

    public function getArticoli()
    {
        $articoli = Articolo::orderBy('id','asc')->get();
        foreach ($articoli as $articolo) {
            $articolo->autori = $articolo->autori()->orderBy('cognome', 'asc')->orderBy('nome','asc')->get();
        }
        return $articoli;
    }

    public function getAutoriByArticolo($articoloId)
    {
        $articolo = Articolo::find($articoloId);
        if ($articolo) {
            return $articolo->autori()->orderBy('cognome', 'asc')->orderBy('nome', 'asc')->get();
        }
        return collect(); 
    }

}