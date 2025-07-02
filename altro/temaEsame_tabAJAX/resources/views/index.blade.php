@extends('layouts.master')
@section('home-active', 'active')

    @section('body')
        <script>

            $(document).ready(function() {

                $('#previous').click(function() {
                    $.ajax({
                        url: '{{ route('ajax.previous') }}',
                        type: 'GET',
                        data: {  
                            id: $('input[name="id"]').val()
                        },
                        success: function(response) {
                            $('input[name="data_appello"]').val(response.data_appello);
                            $('input[name="numero_matricola"]').val(response.numero_matricola);
                            $('input[name="cognome"]').val(response.cognome);
                            $('input[name="nome"]').val(response.nome);
                            $('input[name="nome"]').removeClass('is-invalid');
                            $('input[name="cognome"]').removeClass('is-invalid');
                            $('input[name="numero_matricola"]').removeClass('is-invalid');
                            $('input[name="voto"]').removeClass('is-invalid');
                            $('input[name="data_appello"]').removeClass('is-invalid');

                            $('input[name="id"]').val(response.id);

                            switch (response.voto) {
                                case 33:
                                    response.votoClass = 'Lode';
                                    $('input[name="voto"]').attr('readonly', true);
                                    break;
                                case -1:
                                    response.votoClass = 'Insufficiente';
                                    $('input[name="voto"]').attr('readonly', true);
                                    break;
                                default:
                                    response.votoClass = 'Superato';
                                    $('input[name="voto"]').attr('readonly', false);
                                    break;
                            }
                            $('select[name="votoClass"]').val(response.votoClass);
                            $('input[name="voto"]').val(response.voto);
                        }
                    });
                });

                $('#next').click(function() {
                    $.ajax({
                        url: '{{ route('ajax.next') }}',
                        type: 'GET',
                        data: {  
                            id:     $('input[name="id"]').val()
                        },
                        success: function(response) {
                            $('input[name="data_appello"]').val(response.data_appello);
                            $('input[name="numero_matricola"]').val(response.numero_matricola);
                            $('input[name="cognome"]').val(response.cognome);
                            $('input[name="nome"]').val(response.nome);
                            $('input[name="id"]').val(response.id);
                            $('input[name="nome"]').removeClass('is-invalid');
                            $('input[name="cognome"]').removeClass('is-invalid');
                            $('input[name="numero_matricola"]').removeClass('is-invalid');
                            $('input[name="voto"]').removeClass('is-invalid');
                             $('input[name="data_appello"]').removeClass('is-invalid');
                            switch (response.voto) {
                                case 33:
                                    response.votoClass = 'Lode';
                                    $('input[name="voto"]').attr('readonly', true);
                                    break;
                                case -1:
                                    response.votoClass = 'Insufficiente';
                                    $('input[name="voto"]').attr('readonly', true);
                                    break;
                                default:
                                    response.votoClass = 'Superato';
                                    $('input[name="voto"]').attr('readonly', false);
                                    break;
                            }
                            $('select[name="votoClass"]').val(response.votoClass);                            
                            $('input[name="voto"]').val(response.voto);
                        }
                    });
                });

                $('#form-index').on('submit', function(event) {
                    event.preventDefault(); 

                    var error= false;
                    var dataAppello = $('input[name="data_appello"]').val();
                    var numeroMatricola = $('input[name="numero_matricola"]').val();
                    var matricolaRegex = /^[0-9]{6}$/;
                    var cognome = $('input[name="cognome"]').val();
                    var nome = $('input[name="nome"]').val();
                    var voto = $('input[name="voto"]').val();
                    var votoRegex = /^(1[8-9]|2[0-9]|30)$/;
                    var votoClass = $('select[name="votoClass"]').val();

                    if (numeroMatricola === '') {
                        $('input[name="numero_matricola"]').val('XXXXXX');
                        $('input[name="numero_matricola"]').addClass('is-invalid');
                        !error && $('input[name="numero_matricola"]').focus();
                        error = true;
                    } else if (!matricolaRegex.test(numeroMatricola)) {
                        $('input[name="numero_matricola"]').val('XXXXXX');
                        $('input[name="numero_matricola"]').addClass('is-invalid');
                        !error && $('input[name="numero_matricola"]').focus();
                        error = true;
                    }
                    if (dataAppello === '') {
                        $('input[name="data_appello"]').val('');
                        $('input[name="data_appello"]').addClass('is-invalid');
                        !error && $('input[name="data_appello"]').focus();
                        error = true;
                    }
                    
                    if (cognome === '') {
                        $('input[name="cognome"]').val('');
                        $('input[name="cognome"]').addClass('is-invalid');
                        $('input[name="cognome"]').addClass('error-input');
                        $('input[name="cognome"]').attr('placeholder', 'Cognome');
                        !error && $('input[name="cognome"]').focus();
                        error = true;
                    }
                    if (nome === '') {
                        $('input[name="nome"]').val('');
                        $('input[name="nome"]').addClass('is-invalid');
                        $('input[name="nome"]').attr('placeholder', 'Nome');
                        !error && $('input[name="nome"]').focus();
                        error = true;
                    };
                    if (voto === '') {
                        $('input[name="voto"]').val('');
                        $('input[name="voto"]').addClass('is-invalid');
                        $('input[name="voto"]').attr('placeholder', 'Inserisci Voto');
                        !error && $('input[name="voto"]').focus();
                        error = true;
                    } else if (!votoRegex.test(voto) && votoClass !== 'Lode' && votoClass !== 'Insufficiente') {
                        $('input[name="voto"]').val('');
                        $('input[name="voto"]').addClass('is-invalid');
                        $('input[name="voto"]').attr('placeholder', 'Inserisci Voto');
                        !error && $('input[name="voto"]').focus();
                        error = true;
                    }


                    if (!error) {
                        document.getElementById('form-index').submit();
                    }
                });

                $('select[name="votoClass"]').change(function() {
                    var votoClass = $(this).val();
                    var votoInput = $('input[name="voto"]');
                    
                    switch (votoClass) {
                        case 'Lode':
                            votoInput.val(33);
                            votoInput.attr('readonly', true);
                            break;
                        case 'Insufficiente':
                            votoInput.val(-1);
                            votoInput.attr('readonly', true);
                            break;
                        default:
                            votoInput.val('');
                            votoInput.attr('readonly', false);
                            break;
                    }
                });
            });
        </script>


        <section class="bg-light py-5 px-5 text-center align-items-center">

            <div class="container">
                <h1 class="text-center mb-4">Benvenuto!</h1>
                <p class="text-center mb-4">Qui puoi inserire i dati degli studenti e gestire gli appelli.</p>
               
                <form action="{{ route('home.store') }}" id="form-index" method="POST" class="mb-4">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-3">Data Appello</th>
                                <th class="col-1">NumMatr</th>
                                <th class="col-2">Cognome</th>
                                <th class="col-2">Nome</th>
                                <th class="col-3">Voto</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        <input type="date" name="data_appello" class="form-control" value="{{ $firstStudente->data_appello->format('Y-m-d') }}" >
                                    </td>
                                    <td>
                                        <input type="number" name="numero_matricola" class="form-control" value="{{ $firstStudente->numero_matricola }}" >
                                        <input type="hidden" name="id" value="{{ $firstStudente->id }}" >
                                    </td>
                                    <td>
                                        <input type="text" name="cognome" class="form-control" value="{{ $firstStudente->cognome }}" >
                                    </td>
                                    <td>
                                        <input type="text" name="nome" class="form-control" value="{{ $firstStudente->nome }}" >
                                    </td>
                                    <td>
                                        
                                        @php 
                                            switch ($firstStudente->voto) {
                                                case '33':
                                                    $votoClass = 'Lode';
                                                    $readOnly = 'readonly';
                                                    break;
                                                case '-1':
                                                    $votoClass = 'Insufficiente';
                                                    $readOnly = 'readonly';
                                                    break;
                                                default:
                                                    $votoClass = 'Superato';
                                                    $readOnly = '';
                                                    break;
                                            }
                                        @endphp
                                        <select name="votoClass" class="form-select" " >
                                            <option hidden selected value="{{ $firstStudente->voto }}">{{ $votoClass }}</option>
                                            <option value ="Superato">Superato</option>
                                            <option value ="Lode">Lode</option>
                                            <option value ="Insufficiente">Insufficiente</option>
                                        </select>
                                        <input type="number" name="voto" class="form-control mt-2" placeholder="Inserisci Voto" value="{{ $firstStudente->voto }}" {{ $readOnly }} >
                                    </td>
                                </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="1" class="text-center">
                                    <button type="button" class="btn btn-secondary  w-100" id="previous"><</button>
                                </td>
                                <td colspan="3" class="text-center">
                                    <button type="submit" class="btn btn-primary w-100"">Salva</button>
                                </td>
                                <td colspan="1" class="text-center">
                                    <button type="button" class="btn btn-secondary w-100"" id="next">></button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </section>
        
    @endsection