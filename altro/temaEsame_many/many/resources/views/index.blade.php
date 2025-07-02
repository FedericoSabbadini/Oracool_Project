@extends('layouts.master')
@section('home-active', 'active')

    @section('body')
        <script>

            $(document).ready(function() {
                $('.open-modal').each(function() {
                    $(this).on('click', function() {
                        var id = $(this).attr('id');
                        var titolo = $('#' + id + '-titolo').text();

                        $('#articleModal .modal-title').text('"' + titolo + '"');
                        $('#articleModal .modal-body').html('<p>Caricamento in corso...</p>');

                        $.ajax({
                            url: '{{ route('home.autori') }}',
                            type: 'GET',
                            data: {
                                articolo_id: id
                            },
                            success: function(data) {
                                html = '<ul class="list-group">';
                                data.autori.forEach(function(autore) {
                                    html += '<li class="list-group-item">' + autore.cognome + ' ' + autore.nome + '</li>';
                                    html += '<li class="list-group-item">Email: ' + autore.email + '</li>';
                                    html += '<li class="list-group-item">Istituto: ' + autore.istituto + '</li>';
                                    html += '<br>';
                                });
                                html += '</ul>';
                                $('#articleModal .modal-body').html(html);
                            },
                                
                        });

                    });
                });
            });
        </script>


        <section class="bg-light py-5 px-5">
            <div class="container">
                <h1 class="mb-4">Articoli</h1>
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-6">Titolo</th>
                            <th class="col-3">Autori</th>
                            <th>Info</th>
                            <th class="col-2">Data di pubblicazione</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articoli as $articolo)
                            <tr>
                                <td>{{ $articolo->id }}</td>
                                <td id="{{ $articolo->id }}-titolo">
                                    {{ $articolo->titolo }}

                                </td>
                                <td>
                                    @foreach ($articolo->autori as $autore)
                                        {{ $autore->cognome }} {{ $autore->nome }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <button class="btn open-modal" data-bs-toggle="modal" data-bs-target="#articleModal" id="{{ $articolo->id }}">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                                </td>
                                <td>{{ $articolo->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        <modal id="articleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dettaglio Autori dell'Articolo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Contenuto dell'articolo...</p>
                    </div>
                </div>
            </div>
        </modal>
        
    @endsection