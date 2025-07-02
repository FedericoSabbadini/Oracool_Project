@extends ('layouts.master')

@section('edit-active', 'active')

@section('content')
       <script>

        $(document).ready(function() {
            let error = false;

            $('#edit-form').submit(function(event) {
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
                                $('#edit-form')[0].submit();
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


            let studentId = @json($student->id);            
            if ($('.prev-btn').length) {
                $('.prev-btn').on('click', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '{{ route('home.next') }}',
                        type: 'GET',
                        data: {
                            id: studentId,
                            which:'0',
                        },
                        success: function(data) {
                        window.location.href = '{{ route("home.edit") }}' + '?id=' + data.next.id;
                        }
                    })
                });
            }

            if ($('.next-btn').length) {
                $('.next-btn').on('click', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '{{ route('home.next') }}',
                        type: 'GET',
                        data: {
                            id: studentId,
                            which:'1',
                        },
                        success: function(data) {
                            window.location.href = '{{ route("home.edit") }}' + '?id=' + data.next.id;
                        }
                    })
                });
            }

           

        });
    </script>


    <section class="bg-light py-5 px-5">
        <form action="{{ route('home.update') }}" method="POST" id="edit-form" novalidate>
        @csrf
            <table class="table table-striped table-bordered">
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
                            <input type="date" name="dataAppello" value="{{ \Carbon\Carbon::parse($student->dataAppello)->format('Y-m-d') }}" class="form-control" >
                        </td>
                        <td>
                            <input type="text" name="numMatricola" value="{{$student->numMatricola}}" class="form-control" >
                            <input type="hidden" name="id" value="{{$student->id}}">
                        </td>
                        <td>
                            <input type="text" name="cognome" class="form-control" value="{{$student->cognome}}" >
                        </td>
                        <td>
                            <input type="text" name="nome" class="form-control" value="{{$student->nome}}" >
                        </td>
                        <td>
                            <div class="d-flex gap-4">
                            @php
                                $opzione = $student->voto == -1 ? 'Insufficiente' : ($student->voto != 33 ? 'Esame Superato' : 'Lode');
                            @endphp
                                 <select name="votoClass" class="form-control" style="width: 70%"">
                                    <option value="I">Insufficiente</option>
                                    <option selected value="S">Esame Superato</option>
                                    <option value="L">Lode</option>
                                </select> 
                                <input type="number" name="voto" class="form-control" style="width: 30%"  value="{{$student->voto}}">
                            </div>
                        </td>
                    
                    
                        <td>
                            <button type="submit" class="btn btn-primary">Salva</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-outline-primary prev-btn"><-</button>
            <button class="btn btn-outline-primary next-btn">-></button>

        </form>
    </section>
@endsection