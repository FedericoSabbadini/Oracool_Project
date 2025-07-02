@extends('layouts.master')
@section('home-active', 'active')

    @section('body')
        <script>
            $(document).ready(function() {

                $('#formVoto').submit(function(event) {
                    let error=false;
                    event.preventDefault();

                    var cognome = $('input[name="cognome"]').val();
                    var nome = $('input[name="nome"]').val();
                    var numero_matricola = $('input[name="numero_matricola"]').val();
                    var voto = $('input[name="voto"]').val();
                    var data_esame = $('input[name="data_esame"]').val();
                    var cognomeRegex = /^[A-Za-z]+$/;
                    var nomeRegex = /^[A-Za-z]+$/;
                    var numeroMatricolaRegex = /^[0-9]+$/;
                    var votoRegex = /^(?:[0-9]|[1-2][0-9]|30)$/;

                    if( cognome.trim() === '' || !cognomeRegex.test(cognome)) {
                        $('#cognome-span').attr('hidden', false);
                        $('input[name="cognome"]').addClass('is-invalid');
                        $('input[name="cognome"]').addClass('error-input');
                        !error && $('input[name="cognome"]').focus();
                        error = true;
                    } else {
                        $('#cognome-span').attr('hidden', true);
                        $('input[name="cognome"]').removeClass('is-invalid');
                        $('input[name="cognome"]').removeClass('error-input');
                    }
                    if( nome.trim() === '' || !nomeRegex.test(nome)) {
                        $('#nome-span').attr('hidden', false);
                        $('input[name="nome"]').addClass('is-invalid');
                        $('input[name="nome"]').addClass('error-input');
                        !error && $('input[name="nome"]').focus();  
                        error = true;
                    } else {
                        $('#nome-span').attr('hidden', true);
                        $('input[name="nome"]').removeClass('is-invalid');
                        $('input[name="nome"]').removeClass('error-input');
                    }
                    if( numero_matricola.trim() === '' || !numeroMatricolaRegex.test(numero_matricola) || parseInt(numero_matricola) <= 0) {
                        $('#numero_matricola-span').attr('hidden', false);
                        $('input[name="numero_matricola"]').addClass('is-invalid');
                        $('input[name="numero_matricola"]').addClass('error-input');
                        !error && $('input[name="numero_matricola"]').focus();
                        error = true;
                    } else {
                        $('#numero_matricola-span').attr('hidden', true);
                        $('input[name="numero_matricola"]').removeClass('is-invalid');
                        $('input[name="numero_matricola"]').removeClass('error-input');
                    }
                    if( voto.trim() === '' || !votoRegex.test(voto)) {
                        $('#voto-span').attr('hidden', false);
                        $('input[name="voto"]').addClass('is-invalid');
                        $('input[name="voto"]').addClass('error-input');
                        !error && $('input[name="voto"]').focus();
                        error = true;
                    } else {
                        $('#voto-span').attr('hidden', true);
                        $('input[name="voto"]').removeClass('is-invalid');
                        $('input[name="voto"]').removeClass('error-input');
                    }
                    if( data_esame.trim() === '') {
                        $('#data_esame-span').attr('hidden', false);
                        $('input[name="data_esame"]').addClass('is-invalid');
                        $('input[name="data_esame"]').addClass('error-input-val');
                        !error && $('input[name="data_esame"]').focus();
                        error = true;
                    } else {
                        $('#data_esame-span').attr('hidden', true);
                        $('input[name="data_esame"]').removeClass('is-invalid');
                        $('input[name="data_esame"]').removeClass('error-input-val');
                    }
                    

                    if (!error) {
                        $.ajax({
                            url: "{{ route('home.check') }}",
                            type: "GET",
                            data: $(this).serialize(),
                            success: function(response) {
                                if (response.exists) {
                                    alert('Voto positivo già inserito per questo studente');
                                    $('#formVoto')[0].reset();
                                } else if (!response.exists) {
                                    alert('Voto inserito correttamente');
                                    document.getElementById('formVoto').submit();
                                }
                            },
                        });

                    };
                });

                    function updateLodeCheckbox() {
                        var votoInput = $('input[name="voto"]');
                        var lodeCheckbox = $('input[name="lode"]');

                        if (votoInput.val() == 30) {
                            lodeCheckbox.prop('disabled', false);
                        } else {
                            lodeCheckbox.prop('checked', false);
                            lodeCheckbox.prop('disabled', true);
                        }
                    }
                    function updateLodeValue() {
                        var lodeCheckbox = $('input[name="lode"]');
                        if (lodeCheckbox.is(':checked')) {
                            lodeCheckbox.val(1);
                        } else {
                            lodeCheckbox.val(0);
                        }
                    }
                    $('input[name="voto"]').on('input', function() {
                        updateLodeCheckbox();
                    });
                    $('input[name="lode"]').on('change', function() {
                        updateLodeValue();
                    });
                
            });
        </script>

        <section class="bg-primary text-white text-center py-5">
            <div class="container">
                <h2 class="display-4">Welcome!</h2>
                <br>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Voti</th>
                            <th>Media</th>
                            <th>Sufficienti</th>
                            <th>Max</th>
                            <th>Min</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$numVoti}}</td>
                            <td>{{$mediaVoti}}</td>
                            <td>{{$suffVoti}}</td>
                            <td>{{$maxVoto}}</td>
                            <td>{{$minVoto}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bg-light py-5 px-5">
            <form method="POST" action="{{ route('home.store') }}" id="formVoto" class="container">
                @csrf
                <h3 class="text-center mb-4">Inserisci un nuovo voto</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-2">Cognome</th>
                            <th class="col-2">Nome</th>
                            <th class="col-1">Matricola</th>
                            <th class="col-2">Voto</th>
                            <th class="col-2">Data</th>
                            <th class="col-3">Commento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="cognome" class="form-control" placeholder="Rossi">
                                <span hidden class="text-danger mt-1" id="cognome-span">* Required, only letters</span>
                            </td>
                            <td><input type="text" name="nome" class="form-control" placeholder="Mario">
                                <span hidden class="text-danger mt-1" id="nome-span">* Required, only letters</span>
                            </td>
                            <td><input type="text" name="numero_matricola" class="form-control" placeholder="123456">
                                <span hidden class="text-danger mt-1"  id="numero_matricola-span">* Required</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <input type="number" name="voto" class="form-control" placeholder="0-30">
                                    <input type="checkbox" name="lode" class="form-check-input ms-2" value="0" disabled>
                                    <label class="form-check-label text-secondary ms-1">Lode</label>
                                </div>
                                <span hidden class="text-danger mt-1" id="voto-span">* Required, 0-30</span>
                            </td>
                            <td><input type="date" name="data_esame" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                <span hidden class="text-danger mt-1"  id="data_esame-span">* Required</span>
                            </td>
                            <td><textarea name="commenti" class="form-control" placeholder="Inserisci un commento ..." value=""></textarea></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
        </section>
        
    @endsection