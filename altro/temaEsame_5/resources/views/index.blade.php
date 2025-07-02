@extends('layouts.master')

@section('title', 'Home')
@section('home-active', 'active')

    @section('body')
        <script>
            initializeDataTable();
        </script>
        <section class="bg-light py-5 px-5">

            <div class="container">
                <h1 class="display-4">Benvenuto!</h1>
                @php 
                    if ($saldo < 0) {
                        $saldoClass =  'text-danger';
                    } elseif ($saldo > 0) {
                        $saldoClass =  'text-success';
                    }
                @endphp
                <p>Il tuo saldo attuale è: <strong class="{{ $saldoClass }}">{{ $saldo }}</strong></p>
            

            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-1">Data</th>
                        <th class="col-1">Importo</th>
                        <th class="col-6">Descrizione</th>
                        <th class="col-1">Tipo</th>
                        <th class="col-2">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ Carbon\Carbon::parse($transaction->data)->format('d/m/Y') }}</td>
                            <td>{{ $transaction->importo }}</td>
                            <td>{{ $transaction->descrizione }}</td>
                            <td>{{ $transaction->tipo }}</td>
                            <td>
                                <button class="btn btn-primary">
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="text-white no-link ">Modifica</a>
                                </button>
                                <button class="btn btn-danger">
                                    <a href="{{ route('transactions.destroy', $transaction->id) }}" class="text-white no-link">Elimina</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </section>
        
    @endsection