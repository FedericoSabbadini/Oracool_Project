<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transazioni;


class DataLayer extends Model
{

    public function getSaldo() {
        $transazioni = Transazioni::orderBy('data', 'asc')->get();
        $saldo = 0;

        foreach ($transazioni as $transazione) {
            if ($transazione->tipo == 'entrata') {
                $saldo += $transazione->importo;
            } elseif ($transazione->tipo == 'uscita') {
                $saldo -= $transazione->importo;
            }
        }

        return $saldo;
    }

    public function createTransaction ($request) {
        $transazione = new Transazioni();
        $transazione->importo = $request['importo'];
        $transazione->descrizione = $request['descrizione'];
        $transazione->tipo = $request['tipo'];
        $transazione->data = $request['data'];
        $transazione->save();
    }

    public function updateTransaction ($request) {
        $transazione = Transazioni::find($request['id']);
        $transazione->importo = $request['importo'];
        $transazione->descrizione = $request['descrizione'];
        $transazione->tipo = $request['tipo'];
        $transazione->data = $request['data'];
        $transazione->save();
    }

    public function deleteTransaction ($request) {
        $transazione = Transazioni::find($request);
        if ($transazione) {
            $transazione->delete();
        }
    }

    public function getTransactions() {
        return Transazioni::orderBy('data', 'asc')->get();
    }

    public function getTransactionById($id) {
        return Transazioni::find($id);
    }
}