<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Studente;


class DataLayer extends Model
{

    public function getStudenteById($id) {
        return Studente::find($id);
    }

    public function getFirstStudente() {
        return Studente::orderBy('id', 'asc')
            ->first();
    }

    public function getNextStudente($currentId) {
        return Studente::orderBy('id', 'asc')
            ->where('id', '>', $currentId)
            ->first();
    }

    public function getPreviousStudente($currentId) {
        return Studente::orderBy('id', 'asc')
            ->where('id', '<', $currentId)
            ->first();
    }

    public function storeStudente($data) {
        $studente = $this->getStudenteById($data['id']);
        $studente->nome = $data['nome'];
        $studente->cognome = $data['cognome'];
        $studente->data_appello = $data['data_appello'];
        $studente->numero_matricola = $data['numero_matricola'];
        $studente->voto = $data['voto'];


        $studente->save();
    }

}