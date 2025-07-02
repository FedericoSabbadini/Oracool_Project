<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataLayer;

class FrontController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $saldo = $dl->getSaldo();
        $transazioni = $dl->getTransactions();

        return view('index', ['saldo' => $saldo, 'transactions' => $transazioni]);
    } 
}