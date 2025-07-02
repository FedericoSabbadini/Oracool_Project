<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voti;

class DataLayer extends Model
{

    public function getNumVoti()
    {
        return Voti::count();
    }
    public function getMediaVoti()
    {
        $voti = Voti::where('voto', '>=', 18)->pluck('voto');
        if ($voti->isEmpty()) {
            return 0;
        }
        return $voti->avg();
    }
    public function getSuffVoti() 
    {
        return Voti::where('voto', '>=', 18)->count();
    }
    public function getMaxVoto()
    {
        return Voti::max('voto');
    }   
    public function getMinVoto()
    {
        $minimo = Voti::where('voto', '>=', 18)->min('voto');
        return $minimo;
    }
    
    public function getVotoById($id)
    {
        return Voti::find($id);
    }

    public function storeVoto($data)
    {
        $voto = new Voti();
        $voto->nome = $data['nome'];
        $voto->cognome = $data['cognome'];
        $voto->numero_matricola = $data['numero_matricola'];
        if ($data['lode']) {
            $voto->voto = 31; 
        } elseif ($data['voto'] < 18) {
            $voto->voto = -1; 
        } else {
            $voto->voto = $data['voto'];
        }
        $voto->data_esame = $data['data_esame'];
        $voto->commenti = $data['commenti'];
        $voto->save();
    }

    public function checkVoto($data)
    {
        return Voti::where('nome', $data['nome'])
            ->where('cognome', $data['cognome'])
            ->where('numero_matricola', $data['numero_matricola'])
            ->where('voto', '>=', 18)
            ->exists();
    }
}