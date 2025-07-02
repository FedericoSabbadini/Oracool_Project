@extends ('layouts.master')

@section('create-active', 'active')

@section('content')

    <script>

        $(document).ready(function() {
            let error = false;

            $('#create-form').submit(function(event) {
                event.preventDefault();

                var dataAppello = $('input[name="dataAppello"]').val();
                var numMatricola = $('input[name="numMatricola"]').val(); 
                var cognome = $('input[name="cognome"]').val();
                var nome = $('input[name="nome"]').val();
                var votoClass = $('select[name="votoClass"]').val();
                var voto = $('input[name="voto"]').val();

                var numMatricolaRegex = /^\d{6}$/; // Assuming matricola is a 6-digit number
                var votoNumberRegex = /^([1][8-9]|[2][0-9]|[30])$/; // Matches numbers from 18 to 30

                if (numMatricola.trim() === '') {
                    event.preventDefault();
                    $('input[name="numMatricola"]').val('');
                    $('input[name="numMatricola"]').addClass('error-input');
                    $('input[name="numMatricola"]').attr('placeholder', 'XXXXXX');
                    !error && $('input[name="numMatricola"]').focus();
                    error = true;
                } else if (!numMatricolaRegex.test(numMatricola)) {
                    event.preventDefault();
                    $('input[name="numMatricola"]').val('');
                    $('input[name="numMatricola"]').addClass('error-input');
                    $('input[name="numMatricola"]').attr('placeholder', 'XXXXXX');
                    !error && $('input[name="numMatricola"]').focus();
                    error = true;
                }

                if (cognome.trim() === '') {
                    event.preventDefault();
                    $('input[name="cognome"]').val('');
                    $('input[name="cognome"]').addClass('error-input');
                    $('input[name="cognome"]').attr('placeholder', 'Mario');
                    !error && $('input[name="cognome"]').focus();
                    error = true;
                }
                
                if (nome.trim() === '') {
                    event.preventDefault();
                    $('input[name="nome"]').val('');
                    $('input[name="nome"]').addClass('error-input');
                    $('input[name="nome"]').attr('placeholder', 'Rossi');
                    !error && $('input[name="nome"]').focus();
                    error = true;
                }

                if (votoClass == 'S') {
                    if (!votoNumberRegex.test(voto) || voto.trim() === '') {
                        event.preventDefault();
                        $('input[name="voto"]').val('');
                        $('input[name="voto"]').addClass('error-input');
                        $('input[name="voto"]').attr('placeholder', '18-30');
                        !error && $('input[name="voto"]').focus();
                        error = true;
                    }
                }

                if (!error) {
                    $.ajax({
                        url: '{{ route('home.unique') }}', 
                        type: 'GET',
                        data: {
                            dataAppello: dataAppello,
                            numMatricola: numMatricola,
                        },

                        success: function(response) {
                            if (response.unique == 1) {
                                $('#create-form')[0].submit();
                            } else {
                                $('input[name="numMatricola"]').val('');
                                $('input[name="numMatricola"]').attr('placeholder', 'XXXXXX');
                                alert('La matricola inserita è già presente per questa data di appello.');
                                $('input[name="numMatricola"]').focus();

                            }
                        }
                    });
                }
                
            });

            function updateVoto () {
                var votoClass = $('select[name="votoClass"]').val();
                var voto = $('input[name="voto"]').val();

                if (votoClass == 'S') {
                    $('input[name="voto"]').prop('readonly', false);
                    $('input[name="voto"]').val('');
                } else if (votoClass == 'L') {
                    $('input[name="voto"]').prop('readonly', true);
                    $('input[name="voto"]').val('33');
                }  else if (votoClass == 'I') {
                    $('input[name="voto"]').prop('readonly', true);
                    $('input[name="voto"]').val('-1');
                }
                
            }
           $('select[name="votoClass"]').on('change', function() {
                updateVoto();
            });



        });
    </script>

    <section class="bg-light py-5 px-5">
        <form id="create-form" action="{{ route('home.store') }}" method="POST" novalidate>
         @csrf
            <table class="table table-striped table-bordered" id="createTable">
                <thead>
                    <tr>
                        <th  class="col-3">Data Appello</th>
                        <th  class="col-1">Matricola</th>
                        <th  class="col-2">Cognome</th>
                        <th class="col-2" >Nome</th>
                        <th  class="col-3">Voto</th>
                        <th class="col-1">Azione</th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td>
                            <input type="date" name="dataAppello" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </td>
                        <td>
                            <input type="text" name="numMatricola" class="form-control" placeholder="XXXXXX" >
                        </td>
                        <td>
                            <input type="text" name="cognome" class="form-control"  placeholder="Mario" >
                        </td>
                        <td>
                            <input type="text" name="nome" class="form-control"  placeholder="Rossi" >
                        </td>
                        <td>
                            <div class="d-flex gap-4">
                                <select name="votoClass" class="form-control" style="width: 70%"">
                                    <option value="I">Insufficiente</option>
                                    <option selected value="S">Esame Superato</option>
                                    <option value="L">Lode</option>
                                </select> 
                                <input type="number" name="voto" class="form-control" style="width: 30%">
                            </div>
                        </td>

                        <td>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </form>
    </section>
@endsection