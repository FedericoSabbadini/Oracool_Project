<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DataLayer extends Model
{

    public function getArticoli()
    {
        return Articolo::orderBy('id', 'asc')->get();
    }

    public function getAutori()
    {
        return Autore::all();
    }
    public function getArticoloById($id)
    {
        return Articolo::findOrFail($id);
    }
}