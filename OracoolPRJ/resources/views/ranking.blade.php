@extends('layouts.master')


@section('head', __('ranking.page_title'))

@section('ranking-active', 'active')


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
                pageLength: 10,             // Numero di righe per pagina
                searching: true,            // Attiva ricerca
                ordering: true,             // Attiva ordinamento
                paging: true,               // Attiva paginazione
                info: true,                 // Mostra info sulle righe visualizzate
                lengthChange: true,         // Permetti di cambiare il numero di righe per pagina
                autoWidth: false,           // Disabilita la larghezza automatica delle colonne
                scrollX: false,             // Disabilita la barra di scorrimento orizzontale

                // Personalizzazione layout: ricerca e paginazione nella stessa riga sopra la tabella
                dom: '<"row"<"col-6"f><"col-6 custom-pagination"p>>' +  // Per schermi più piccoli la paginazione e ricerca sono su righe separate
                    '<"row"<"col-12"tr>>',// La tabella
                // Personalizzare il comportamento delle colonne
                columnDefs: [
                    { 
                        orderable: false, 
                        targets: 1 // Disabilita ordinamento sulla colonna della posizione

                    }
                ],

                // Impostazioni per la ricerca
                language: {
                    search: "_INPUT_", // Cambia la ricerca da "Search" a un input più pulito
                    searchPlaceholder: "{{ __('ranking.search_placeholder') }}", // Use translated placeholder
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>'
                    },
                },

                // Aggiungere altre funzionalità
                responsive: true,  // Rende la tabella più responsive su dispositivi mobili
                stateSave: true    // Salva lo stato della tabella (pagina, ordinamento, etc.)
            });

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
            $('#dataTable th:not(:nth-child(2))').css('cursor', 'pointer');

        });
    </script>

    <div class="row bg-gradient-secondary justify-content-center pt-2 pb-3 px-4">
        
        <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
            <div class="table-responsive my-5">
                <table class="table table-striped table-bordered text-center table-hover align-middle" id="dataTable">
                    <thead class="table-dark ">
                        <tr>
                            <th scope="col">{{ __('ranking.table_header_position') }}</th>
                            <th scope="col">{{ __('ranking.table_header_user') }}</th>
                            <th class="d-none d-md-table-cell" scope="col">{{ __('ranking.table_header_points') }}</th>
                            <th class="pers-th d-none d-md-table-cell" scope="col">{{ __('ranking.table_header_predictions') }}</th>
                            <th scope="col">{{ __('ranking.table_header_accuracy') }}</th>
                            <th class="pers-th d-none d-lg-table-cell" scope="col">{{ __('ranking.table_header_update') }}</th>

                        </tr>
                    </thead>                            
                    <tbody>
                        @php 
                            $num=0;
                            $points1=0;
                        @endphp
                        @foreach ($users as $user)
                            @php
                                $num=$num+1;
                                $totPredictions = $user->predictions->where('value', '!=', null)->count();
                                $correctPredictions = $user->predictions->where('value', 1)->count();
                                $accuracy = $totPredictions > 0 ? round(($correctPredictions / $totPredictions) * 100, 2) : 0;
                                $lastPrediction = $user->predictions->sortByDesc('created_at')->pluck('created_at')->first();

                                $colorUser = '';
                                $colorRanking = '';
                                if (Auth::check() && $user->id == Auth::user()->id)
                                    $colorUser = 'table-info';

                                if ($num == 1 || $user->points == $points1) {
                                    $colorRanking = 'text-warning'; 
                                    $points1 = $user->points;
                                } else {
                                    $colorRanking = ''; // No color for others
                                }

                            @endphp
                            <tr class="table-row {{$colorUser}}">
                                <th scope="row"><span>{{$num}}</span></th>
                                <td>
                                    @if(Auth::check())
                                        <a class="no-link {{$colorRanking}}" href="{{ route('userProfile.show', ['userProfile' => $user->id]) }}">{{ '@' . $user->name }}</a>
                                    @else
                                        <a class="no-link disabled-link {{$colorRanking}}" disabled;">{{ '@' . $user->name }}</a>
                                    @endif                               
                                </td>
                                <td class="d-none d-md-table-cell">{{ number_format($user->points, 2, '.', '') }}</td>
                                <td class="d-none d-md-table-cell">{{$totPredictions}}</td>
                                <td >{{$accuracy . '%'}}</td>
                                <td class="d-none  d-lg-table-cell text-secondary small">{{ \Carbon\Carbon::parse($lastPrediction)->translatedFormat('d-M-y') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
    </div>            
@endsection