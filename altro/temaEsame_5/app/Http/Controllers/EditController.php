<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\DataLayer;

class EditController extends Controller
{
    public function show(Request $request, $transaction)
    {
        $dl = new DataLayer();
        $transaction = $dl->getTransactionById($transaction);
        
        return view('editTransaction', ['transaction' => $transaction]);
    }

    public function update(Request $request)
    {
        $dl = new DataLayer();
        $dl->updateTransaction($request);

        return redirect()->route('home.index')
            ->with('message', 'Transaction updated successfully!');
    }

    public function destroy(Request $request,  $transaction)
    {
        $dl = new DataLayer();
        $dl->deleteTransaction($transaction);

        return redirect()->route('home.index')
            ->with('message', 'Transaction deleted successfully!');
    }
}
