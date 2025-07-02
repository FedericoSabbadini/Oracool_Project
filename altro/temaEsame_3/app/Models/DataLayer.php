<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exams;


class DataLayer extends Model
{
    public function getVoti()
    {
        $voti = Exams::select('voto')
            ->orderBy('voto', 'desc')
            ->get();
        return $voti;
    }

    public function storeVoto($data)
    {
        $esame = new Exams();
        $esame->nome = $data['nome'];
        $esame->cognome = $data['cognome'];
        $esame->lode = isset($data['lode']) ? true : false;
        if ($esame->lode) {
            $esame->voto = 31;
        } else {
        $esame->voto = $data['voto'];
        }
        $esame->data_esame = $data['data'];
        $esame->commenti = $data['commento'] ?? '';
        $esame->numMatricola = $data['numMatricola']; 
        $esame->save();
    }

    public function isUnique($data)
    {
        return !Exams::where('numMatricola', $data['numMatricola'])->where('nome', $data['nome'])
            ->where('cognome', $data['cognome'])
            ->where('voto', '>', 17)
            ->exists();
    }
}