@extends('layouts.master')

    @section('body')

        <script>
            $('document').ready(function() {

                $('#formVoti').submit(function(event) {
                    event.preventDefault();

                    var nome = $('input[name="nome"]').val();
                    var cognome = $('input[name="cognome"]').val();
                    var numMatricola = $('input[name="numMatricola"]').val();
                    var voto = $('input[name="voto"]').val();
                    var data = $('input[name="data"]').val();
                    var commento = $('input[name="commento"]').val();
                    var lode = $('input[name="lode"]').is(':checked') ? 1 : 0;
                    var error = false;

                    if (nome === '') {
                        event.preventDefault();
                        $('input[name="nome"]').next('span').text('Nome obbligatorio');
                        !error && $('input[name="nome"]').focus();
                        error = true;
                    } else {
                        $('input[name="nome"]').next('span').text('');
                    }
                    if (cognome === '') {
                        event.preventDefault();
                        $('input[name="cognome"]').next('span').text('Cognome obbligatorio');
                        !error && $('input[name="cognome"]').focus();
                        error = true;
                    } else {
                        $('input[name="cognome"]').next('span').text('');
                    }
                    if (numMatricola === '') {
                        event.preventDefault();
                        $('input[name="numMatricola"]').next('span').text('Numero di Matricola obbligatorio');
                        !error && $('input[name="numMatricola"]').focus();
                        error = true;
                    } else if (isNaN(numMatricola) || numMatricola <= 0) {
                        event.preventDefault();
                        $('input[name="numMatricola"]').next('span').text('Numero di Matricola deve essere un numero positivo');
                        !error && $('input[name="numMatricola"]').focus();
                        error = true;
                    } else {
                        $('input[name="numMatricola"]').next('span').text('');
                    }
                    if (voto === '' || isNaN(voto) || voto < 0 || voto > 30) {
                        event.preventDefault();
                        $('input[name="voto"]').next('span').text('Voto obbligatorio, >=0, <=30');
                        !error && $('input[name="voto"]').focus();
                        error = true;
                    } else {
                        $('input[name="voto"]').next('span').text('');
                    }

                    if (!error) {
                        $.ajax({
                            url: '{{ route('home.ajax') }}',
                            type: 'GET',
                            data: {
                                nome: nome,
                                cognome: cognome,
                                numMatricola: numMatricola,
                            },
                            success: function(response) {
                                // Gestisci la risposta del server
                                if (response.status === 'success') {
                                    document.getElementById('formVoti').submit();
                                    alert('Voto inserito con successo!');


                                } else if (response.status === 'error') {
                                    alert('Voto già presente per questo studente.');
                                    document.getElementById('formVoti').reset();
                                }
                            },
                        });
                    }
                });

                function checkVotoLode() {
                    var voto = parseFloat($('input[name="voto"]').val());
                    if (voto === 30) {
                        $('input[name="lode"]').prop('disabled', false);
                    } else {
                        $('input[name="lode"]').prop('disabled', true).prop('checked', false);
                    }
                }

                $('input[name="voto"]').on('change', function() {
                    checkVotoLode();
                });
            });

        </script>

        <section class="bg-primary text-white text-center py-5">
                @php 
                    $numVoti = $voti->count();
                    $mediaVoti = $numVoti > 0 ? $voti->sum('voto') / $numVoti : 0;
                    $suffVoti = $voti->where('voto', '>=', 18)->count() / $numVoti * 100;
                    $maxVoto = $voti->max('voto');
                    $minVoto = $voti->min('voto');
                @endphp
            <div class="container">
                <h1 class="mb-4">Statistiche sui Voti</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Numero di Voti</th>
                            <th>Media Voti</th>
                            <th>Sufficienze (%)</th>
                            <th>Voto Massimo</th>
                            <th>Voto Minimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $numVoti }}</td>
                            <td>{{ number_format($mediaVoti, 2) }}</td>
                            <td>{{ number_format($suffVoti, 2) }}%</td>
                            <td>{{ $maxVoto }}</td>
                            <td>{{ $minVoto }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bg-light py-5 px-5">
            <div class="container">
                <form action="{{ route('home.store') }}" method="POST" id="formVoti">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control" name="nome" style="width: 70%" placeholder="Nome">
                        <span class="text-danger" style="width: 30%"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="cognome" style="width: 70%" placeholder="Cognome">
                        <span class="text-danger" style="width: 30%"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="numMatricola" style="width: 70%" placeholder="Numero di Matricola">
                        <span class="text-danger" style="width: 30%"></span>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="voto" style="width: 70%" placeholder="Inserisci un voto">
                        <span class="text-danger" style="width: 30%"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="lode" value="1">
                            Lode
                        </label>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" name="data" style="width: 70%" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                        <span class="text-danger" style="width: 30%"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="commento" style="width: 70%" placeholder="Commento (opzionale)">
                        <span class="text-danger" style="width: 30%"></span>
                    </div>

                    <button type="reset" class="btn btn-secondary">Cancella</button>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </section>
        
    @endsection