@extends('layouts.master')

@section('back')
    <a href="{{ route('controlPanel.index') }}" class="text-white text-decoration-none d-inline-flex align-items-center gap-1 small back-link">
        <i class="bi bi-arrow-left"></i>
    </a>
@endsection

@section('head', __('predictionList.page_title'))


@if ($action === 'edit')
    @section('predictionEdit-active', 'active')
@else
    @section('predictionClose-active', 'active')
@endif


@section('body')

    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                // Configurazioni generali


                searching: true,            // Attiva ricerca
                ordering: true,             // Attiva ordinamento
                paging: true,               // Attiva paginazione
                info: true,                 // Mostra info sulle righe visualizzate
                lengthChange: true,         // Permetti di cambiare il numero di righe per pagina
                autoWidth: false,           // Disabilita la larghezza automatica delle colonne
                scrollX: false,             // Disabilita la barra di scorrimento orizzontale
                pageLength: 8,             // Changed from 10 to 8 to match lengthMenu default

                // Personalizzazione layout: ricerca e paginazione nella stessa riga sopra la tabella
                dom: '<"row"<"col-6"f><"col-6 custom-pagination"p>>' +  // Per schermi più piccoli la paginazione e ricerca sono su righe separate
                    '<"row"<"col-12"tr>>',// La tabella
                // Personalizzare il comportamento delle colonne
                columnDefs: [
                    { 
                        orderable: false, 
                        targets: [1, 3] // Disabilita ordinamento sulla colonna della posizione

                    }
                ],

                // Impostazioni per la ricerca
                language: {
                    search: "_INPUT_", // Cambia la ricerca da "Search" a un input più pulito
                    searchPlaceholder: "{{ __('predictionList.search_placeholder') }}", // Usa il placeholder tradotto
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>'
                    },
                },

                // Aggiungere altre funzionalità
                responsive: true,  // Rende la tabella più responsive su dispositivi mobili
                stateSave: true    // Salva lo stato della tabella (pagina, ordinamento, etc.)
            });


            table.state.clear();  // Cancella stato salvato
            table.page.len(8).draw();  // Forza 8 righe e ridisegna

            // Migliorare l'estetica del campo di ricerca
            $('.dataTables_filter input').addClass('form-control').css({
                'background-color': '#d7eaff', // Colore di sfondo
                'height': '34px'          // Altezza uniforme con la barra di paginazione
            });

            // Uniformare l'altezza delle barre di paginazione e ricerca
            $('.dataTables_length select').css('height', '38px'); // Altezza uniforme
            $('.dataTables_paginate').css('height', '38px'); // Altezza uniforme

            // modificare la distanza dalla barra di paginazione e centrarla nella riga 
            $('.dataTables_paginate').css({
                'margin-bottom': '20px', // Margine inferiore
        });
        
            
            $('#dataTable_wrapper').css('overflow-x', 'hidden'); // Disabilita la scrollbar orizzontale
        $('#dataTable th').not(':nth-child(2), :nth-child(4)').css('cursor', 'pointer');

        });
    </script>

    <div class="row bg-gradient-secondary justify-content-center pt-2 pb-3 px-4">
        
        <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
            <div class="table-responsive mt-5">
                <table class="table table-striped table-bordered text-center table-hover align-middle" id="dataTable">
                    <thead class="table-dark ">
                        <tr>
                            <th scope="col">{{ __('predictionList.orario') }}</th>
                            <th scope="col">{{ __('predictionList.match') }}</th>
                            <th class="pers-th d-none d-md-table-cell" scope="col">{{ __('predictionList.status') }}</th>
                            <th scope="col">{{ __('predictionList.action') }}</th>
                        </tr>
                    </thead>                            

                    <tbody>
                        @foreach ($eventsFootball as $eventFootball)
                            @php
                                $date = \Carbon\Carbon::parse($eventFootball->start_time)->translatedFormat('d-m-y H:i');
                                $homeTeam = $eventFootball->home_team;
                                $awayTeam = $eventFootball->away_team;
                                $status = $eventFootball->status;

                                $href = $action === 'edit' ? 
                                    route('predictionEdit.show', ['predictionEdit' => $eventFootball->id]) : 
                                    route('predictionClose.show', ['predictionClose' => $eventFootball->id]);

                                $buttonClass = $action === 'edit' ? 'btn-warning' : 'btn-success'; // Arancio per edit, verde per close
                                $buttonText = __('predictionList.' . $action); // Modifica o Chiudi
                            @endphp
                            <tr class="table-row">
                                <td class=" text-secondary small">{{ $date }}</td>
                                <td>{{ $homeTeam }} <span class="text-secondary small">vs</span> {{ $awayTeam }}</td>
                                <td class="d-none d-md-table-cell">{{ $status }}</td>
                                <td>
                                    <!-- Bottone con il colore dinamico -->
                                    <a href="{{ $href }}" class="btn {{ $buttonClass }} btn-sm">{{ $buttonText }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($action === 'edit')
                <div class="row align-items-end mt-2 mb-4">
                    <div class="col-12 d-flex justify-content-end">
                        <form action="{{ route('admin.odds.update') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-sync-alt"></i> {{ __('predictionList.quotes') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif

        </div>       
    </div>            
@endsection
