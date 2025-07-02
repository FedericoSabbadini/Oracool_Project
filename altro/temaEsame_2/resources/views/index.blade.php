@extends('layouts.master')

    @section('body')
        <script>
            $('document').ready(function() {
            
                $('.open-modal').click(function() {
                    var idArticolo = $(this).attr('data-id');
                    $.ajax({
                        type: 'GET',
                        url: '/articolo/' + idArticolo,
                        success: function(data) {
                            html = '<ul>';
                            data.autori.forEach(function(autore) {
                                html += '<li>' + autore.name + ' ' + autore.surname + '<br>' +
                                        'Email: ' + autore.email + '<br>' +
                                        'Affiliazione: ' + autore.istituto + '</li>';
                            });


                            $('#articleModal .modal-body').html(html + '</ul>');
                        },
                    });
                });
            

            });
        </script>


        <section class="bg-light py-5 px-5">

            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col">Autori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articoli as $articolo)
                    @php 
                        $autori = $articolo->autori->sortBy('surname')->sortBy('name');
                    @endphp
                        <tr>
                            <td><a class="no-link open-modal" data-id="{{ $articolo->id }}" data-bs-toggle="modal" data-bs-target="#articleModal"href="#">{{ $articolo->titolo }}</a></td>
                            <td>
                                @foreach($autori as $autore)
                                    {{ $autore->name }} {{ $autore->surname }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>




            <div class="modal fade" id="articleModal" tabindex="-1" aria-labelledby="articleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="articleModalLabel">Dettagli Articolo: Autori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endsection