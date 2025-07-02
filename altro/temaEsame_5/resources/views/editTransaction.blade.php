@extends('layouts.master')

@section('title', 'Modifica')
@section('edit-active', 'active')

@section('body')
<script>
        $(document).ready(function() {
            $('#transactionForm').on('submit', function(event) {
                event.preventDefault(); 
                let isValid = false;

                var data = $('input[name="data"]').val();
                var importo = $('input[name="importo"]').val();
                var descrizione = $('input[name="descrizione"]').val();
                var tipo = $('select[name="tipo"]').val();

                if (importo == '') {
                    $('input[name="importo"]').addClass('error-input');
                    $('input[name="importo"]').attr('placeholder', 'XXX.XX');
                    !isValid && $('input[name="importo"]').focus();
                    isValid = true;
                } else if (isNaN(importo) || parseFloat(importo) <= 0) {
                    $('input[name="importo"]').addClass('error-input');
                    $('input[name="importo"]').attr('placeholder', 'XXX.XX');
                    !isValid && $('input[name="importo"]').focus();
                    isValid = true;
                } 

                if (tipo == null) {
                    $('select[name="tipo"]').addClass('error-input-val');
                    !isValid && $('select[name="tipo"]').focus();
                    isValid = true;
                }

                if (!isValid) {
                    this.submit(); // Submit the form if all validations pass
                }
            });
        });
    </script>
    <section class="bg-light py-5 px-5">

        <div class="container">
            <form action="{{ route('transactions.update')}}" method="POST" id="transactionForm">
                    @csrf

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-2">Data</th>
                            <th class="col-1">Importo</th>
                            <th class="col-6">Descrizione</th>
                            <th class="col-2">Tipo</th>
                            <th class="col-1">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="date" name="data" class="form-control" value="{{ Carbon\Carbon::parse($transaction->data)->format('Y-m-d') }}">
                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                            </td>
                            <td>
                                <input type="text" name="importo" class="form-control" value="{{ $transaction->importo }}">
                            </td>
                            <td>
                                <input type="text" name="descrizione" class="form-control" value="{{ $transaction->descrizione }}">
                            </td>
                            <td>
                                @php 
                                    $tipoSelected = $transaction->tipo;
                                    if ($tipoSelected === 'entrata') {
                                        $tipoSelectedEntrata = 'selected';
                                        $tipoSelectedUscita = '';
                                    } else {
                                        $tipoSelectedUscita = 'selected';
                                        $tipoSelectedEntrata = '';
                                    }
                                @endphp
                                <select name="tipo" class="form-select">
                                    <option value="" disabled hidden selected>Seleziona tipo</option>
                                    <option value="entrata" {{ $tipoSelectedEntrata }}>Entrata</option>
                                    <option value="uscita" {{ $tipoSelectedUscita }}>Uscita</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success">Edit</button>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </form>
        </div>
    </section>
        
        
@endsection