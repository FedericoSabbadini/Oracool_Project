<!DOCTYPE html>

<html lang="it">

    <head>
        <title>
            @yield('head')
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Caricamento CSS per Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- CSS personalizzato -->
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet">
        <link href="{{ url('/') }}/css/dataTables.css" rel="stylesheet">

        <!-- Font Awesome per le icone -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Caricamento jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <!-- Caricamento Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
        <!-- Caricamento myScript -->
        <script src="{{ url('/') }}/js/timezone.js"></script> <!-- Uso della versione senza "slim" -->
        
        <!-- Caricamento DataTables CSS e JS -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        
    </head>

    <body>
        <script>
        $(document).ready(function() {
                console.log("DataTables inizializzato");

            var table = $('#dataTable').DataTable({
                // Configurazioni generali
                pageLength: 1,             // Numero di righe per pagina
                searching: true,            // Attiva ricerca
                ordering: true,             // Attiva ordinamento
                paging: true,               // Attiva paginazione
                info: true,                 // Mostra info sulle righe visualizzate
                lengthChange: false,         // Permetti di cambiare il numero di righe per pagina
                autoWidth: false,           // Disabilita la larghezza automatica delle colonne
                scrollX: false,             // Disabilita la barra di scorrimento orizzontale
                pagingType: "simple",       // Usa la paginazione semplice (precedente/successivo)
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
                    searchPlaceholder: "Cerca", // Use translated placeholder
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>'
                    },
                },

                // Aggiungere altre funzionalità
                responsive: true,  // Rende la tabella più responsive su dispositivi mobili
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

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container px-4">
                
                <div class="navbar-brand">
                    <strong>Programmazione Web</strong>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item pe-2"><a class="nav-link @yield('home-active')" href="{{ route('home.index') }}">HOME</a></li>
                        <li class="nav-item pe-2"><a class="nav-link @yield('edit-active')" href="{{ route('home.edit') }}">EDIT</a></li>
                        <li class="nav-item"><a class="nav-link @yield('create-active')" href="{{ route('home.create') }}">CREATE</a></li>

                    </ul>
                </div>
            </div>
        </nav>

        

        
        <div class="separator"></div>
        <div class="container-fluid px-0">
            @yield('content')
        </div>

        <footer class="container px-4 text-white"></footer>
    </body>
</html>
