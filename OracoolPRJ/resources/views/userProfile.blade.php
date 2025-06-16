@extends('layouts.master')

    @if ($user->id == Auth::user()->id) 
            @section('userProfile-active', 'active')
            @section('head', __('userProfile.page_title_own'))
        
    @endif

    @if ($user->id != Auth::user()->id) 
        @section('ranking-active', 'active')
        @section('head', __('userProfile.page_title_other'))
        @section('back')
            <a href="{{ url()->previous() }}" class="text-white text-decoration-none d-inline-flex align-items-center gap-1 small back-link">
                <i class="bi bi-arrow-left"></i>
            </a>
        @endsection
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
            pageLength: 9,             // Numero di righe per pagina
            searching: false,           // Disattiva ricerca
            ordering: true,             // Attiva ordinamento
            paging: true,               // Attiva paginazione
            info: false,                 // Mostra info sulle righe visualizzate
            lengthChange: true,         // Permetti di cambiare il numero di righe per pagina
            autoWidth: false,           // Disabilita la larghezza automatica delle colonne
            scrollX: false,             // Disabilita la barra di scorrimento orizzontale

            // Personalizzazione layout: ricerca e paginazione nella stessa riga sopra la tabella
            dom: 
                '<"row"<"col-12"tr>>' + 
                '<"row"<"col-12 custom-pagination"p>>', // La tabella

            columnDefs: [
                { 
                    orderable: false, 
                    targets: [1, 3], // Disabilita ordinamento sulla colonna della posizione
                }
            ],

            // Impostazioni per la ricerca
            language: {
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
        table.page.len(9).draw();  // Forza 8 righe e ridisegna

        // Uniformare l'altezza delle barre di paginazione e ricerca
        $('.dataTables_length select').css('height', '38px'); // Altezza uniforme
        $('.dataTables_paginate').css('height', '38px'); // Altezza uniforme

        // Modificare la distanza dalla barra di paginazione e centrarla nella riga 
        $('.dataTables_paginate').css({
            'margin-top': '10px' // Margine inferiore
        });

        $('#dataTable_wrapper').css('overflow-x', 'hidden'); // Disabilita la scrollbar orizzontale
        $('#dataTable th').not(':nth-child(2), :nth-child(4)').css('cursor', 'pointer');

    });
</script>

        <div class="row bg-gradient-secondary justify-content-center py-4">
        <!-- Info Utente -->
            <div class="col-9 col-sm-9 col-md-7 col-lg-5 col-xl-4">
                    <div class="card text-center shadow mx-4 mt-5 mb-4 card-profile">
                        <section class="card-body">
                            <h4 class="card-title">
                                <a class="no-link" href="{{ route('ranking.index') }}" >{{ '@' . $user->name }}</a>
                            </h4>
                            <p class="text-muted">{{ __('userProfile.member_since') }} {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('M Y')}}</p>
                            <hr />

                            @php
                            $totPredictions = $userPredictions->where('value', '!=', null)->count();
                            $correctPredictions = $userPredictions->where('value', 1)->count();
                            $accuracy = $totPredictions > 0 ? round(($correctPredictions / $totPredictions) * 100, 2) : 0;
                            $lastAccess = \Carbon\Carbon::parse($user->last_access)->translatedFormat('d-m-y H:i');
                            @endphp
                            <p><strong>{{ __('userProfile.points') }}</strong> <span class="text-muted">{{number_format($user->points, 2, '.', '')}}</span></p>
                            <p><strong>{{ __('userProfile.total_predictions') }}</strong> {{ $totPredictions}}</p>
                            <p><strong>{{ __('userProfile.correct_predictions') }}</strong> {{$correctPredictions}}</p>
                            <p><strong>{{ __('userProfile.accuracy') }}</strong> <span class="{{ $accuracy > 75 ? 'text-success' : ($accuracy > 50 ? 'text-warning' : 'text-danger') }}">{{$accuracy . '%'}}</span></p>
                            <p><strong>{{ __('userProfile.lastAccess') }}</strong> <span class="text-secondary small">{{ $lastAccess }}</span></p>
                        </section>
                    </div>
            </div>


            <!-- Storico Pronostici -->
            <div class="col-12 col-sm-11 col-md-11 col-lg-6 col-xl-7 px-4">
                <div class="table-responsive mt-5 mb-4">
                <table class="table table-striped text-center align-middle table-hover table-bordered" id="dataTable">
                    <thead class="table-dark ">
                    <tr>
                        <th class="pers-th">{{ __('userProfile.history_date') }}</th>
                        <th>{{ __('userProfile.history_match') }}</th>
                        <th class="pers-th d-none d-md-table-cell" scope="col">{{ __('userProfile.history_prediction') }}</th>
                        <th>{{ __('userProfile.history_result') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($userPredictions as $prediction)
                        @php
                            $event=$userEvents->where('id', $prediction->event_id)->first();
                            $date= \Carbon\Carbon::parse($event->start_time)->translatedFormat('d-m-y');


                            if ($event->type == 'football') {
                                $predictionFootball=$userPredictionsFootball->where('id', $prediction->id)->first();
                                $eventFootball=$userEventsFootball->where('id', $prediction->event_id)->first();
                                $homeTeam = $eventFootball->home_team;
                                $awayTeam = $eventFootball->away_team;

                                if($predictionFootball->predicted_1) {
                                    $result = '1';
                                } elseif($predictionFootball->predicted_X) {
                                    $result = 'X';
                                } elseif($predictionFootball->predicted_2) {
                                    $result = '2';
                                } else {
                                    $result = 'null';
                                }

                                $goalA= $eventFootball->home_score;
                                $goalB= $eventFootball->away_score;
                            }

                        @endphp
                        <tr>
                            <td class=" text-secondary small">{{ $date }}</td>
                            <td>{{ $homeTeam }} <span class="text-secondary small">vs</span> {{ $awayTeam }}</td>
                            <td class="d-none d-md-table-cell"><strong>{{ $result }}</strong></td>
                            <td><span class="badge {{ $prediction->value=='1' ? 'bg-success' 
                            : ($prediction->value == '0' ? 'bg-danger' : 'bg-warning') }}">{{ $goalA . '-' . $goalB }}</span></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                </div>
            </div>        
        </div>
        
    @endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      setTimezone();
    });
  </script>
@endsection