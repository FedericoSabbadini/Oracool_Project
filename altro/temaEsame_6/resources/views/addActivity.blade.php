@extends('layouts.master')
@section('activities-active', 'active')

    @section('body')
    <script>
        $(document).ready(function() {
           $('#addActivityForm').on('submit', function(event) {
                event.preventDefault(); 
                var errorForm=false;

                var titolo = $('#titolo').val();
                var descrizione = $('#descrizione').val();
                var completata = $('#completata').is(':checked');

                if (titolo === '') {
                    $('#titolo').addClass('error-input');
                    !errorForm && $('#titolo').focus();
                    errorForm = true;
                }

                if (!errorForm) {
                    document.getElementById('addActivityForm').submit();
                }
               
            });
        });
    </script>

        <section class="bg-light py-5 px-5">
            <form  action="{{ route('activity.store') }}" id="addActivityForm" method="POST">
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-5" >Titolo</th>
                            <th class="col-5">Descrizione</th>
                            <th class="col-1 text-center">Si/No</th>
                            <th class="col-1 text-center">Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Inserisci titolo">
                            </td>
                            <td class="align-middle">
                                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" placeholder="Inserisci descrizione" value=''></textarea>
                            </td>
                            <td class="text-center align-middle">
                                <input type="checkbox" id="completata" name="completata" class="form-check-input" value="0">
                            </td>
                            <td class="text-center align-middle">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </section>
        
    @endsection