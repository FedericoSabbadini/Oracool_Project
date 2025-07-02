<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Studente;

class DataLayer extends Model
{
    public function getStudents() {
        
        return Studente::all();
    }

    public function addStudent($data) {
        $student = new Studente();
        $student->dataAppello = $data['dataAppello'];
        $student->numMatricola = $data['numMatricola'];
        $student->cognome = $data['cognome'];
        $student->nome = $data['nome'];
        $student->voto = $data['voto'];
        $student->save();
    }

    public function updateStudent($data) {
        $student = Studente::find($data['id']);
        if ($student) {
            $student->dataAppello = $data['dataAppello'];
            $student->numMatricola = $data['numMatricola'];
            $student->cognome = $data['cognome'];
            $student->nome = $data['nome'];
            $student->voto = $data['voto'];
            $student->save();
        }
    }

    public function getFirstStudent() {
        return Studente::orderBy('id', 'asc')->first();
    }
    public function getNextStudent($student) {
        return Studente::where('id', '>', $student->id)->orderBy('id', 'asc')->first();
    }
    public function getPrevStudent($student) {
        return Studente::where('id', '<', $student->id)->orderBy('id', 'desc')->first();
    }
    public function getStudentById($id) {
        return Studente::find($id);
    }

    public function isUnique($data) {
        return !Studente::where('numMatricola', $data['numMatricola'])->where('dataAppello', $data['dataAppello'])->exists();
    }
}
