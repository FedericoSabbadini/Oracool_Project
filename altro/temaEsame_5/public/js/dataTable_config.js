/**
 * Inizializza una DataTable con configurazioni personalizzate
 * @param {string} tableId - ID della tabella (default: 'dataTable')
 * @param {Object} options - Opzioni personalizzate per sovrascrivere quelle di default
 */
function initializeDataTable(tableId = 'dataTable', options = {}) {

    $(document).ready(function () {
        // Configurazione di default
        const defaultConfig = {
            // Configurazioni generali
            pageLength: 6,             // Numero di righe per pagina
            searching: true,            // Attiva ricerca
            ordering: true,             // Attiva ordinamento
            paging: true,               // Attiva paginazione
            info: true,                 // Mostra info sulle righe visualizzate
            lengthChange: true,         // Permetti di cambiare il numero di righe per pagina
            autoWidth: false,           // Disabilita la larghezza automatica delle colonne
            scrollX: false,             // Disabilita la barra di scorrimento orizzontale
            pagingType: "simple_numbers", // Tipo di paginazione (numeri semplici)

            // Personalizzazione layout: ricerca e paginazione nella stessa riga sopra la tabella
            dom: '<"row"<"col-6"f><"col-6 custom-pagination"p>>' +  // Per schermi più piccoli la paginazione e ricerca sono su righe separate
                '<"row"<"col-12"tr>>',

            // Personalizzare il comportamento delle colonne
            columnDefs: [
                {
                    orderable: false,
                    targets: 1 // Disabilita ordinamento sulla colonna della posizione
                }
            ],
            order: [[0, 'asc']], // Ordina per la prima colonna in ordine ascendente

            // Impostazioni per la ricerca
            language: {
                search: "_INPUT_", // Cambia la ricerca da "Search" a un input più pulito
                searchPlaceholder: "Cerca...", // Placeholder di default (può essere sovrascritto)
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>'
                },
            },

            // Aggiungere altre funzionalità
            responsive: true,  // Rende la tabella più responsive su dispositivi mobili
        };

        // Unisce la configurazione di default con le opzioni personalizzate
        const config = $.extend(true, {}, defaultConfig, options);
        const table = $('#' + tableId).DataTable(config);

        // Applicazioni di stile personalizzate
        applyCustomStyles(tableId);

        return table;
    });
}

/**
 * Applica gli stili personalizzati alla DataTable
 * @param {string} tableId - ID della tabella
 */
function applyCustomStyles(tableId) {
    // Migliorare l'estetica del campo di ricerca
    $('.dataTables_filter input').addClass('form-control').css({
        'background-color': '#d7eaff', // Colore di sfondo
        'height': '34px'          // Altezza uniforme con la barra di paginazione
    });

    // Uniformare l'altezza delle barre di paginazione e ricerca
    $('.dataTables_length select').css('height', '38px'); // Altezza uniforme
    $('.dataTables_paginate').css('height', '38px'); // Altezza uniforme

    // Modificare la distanza dalla barra di paginazione e centrarla nella riga
    $('.dataTables_paginate').css({
        'margin-bottom': '20px', // Margine inferiore
    });

    $('#' + tableId + '_wrapper').css('overflow-x', 'hidden'); // Disabilita la scrollbar orizzontale
    $('#' + tableId + ' th:not(:nth-child(2))').css('cursor', 'pointer');
}

// Esempio di utilizzo
// <script> initializeDataTable('myTableId', { pageLength: 20, searching: false }); </script> 
// <script> initializeDataTable('myTableId', { searching: false, pagingType: "full_numbers" }); </script>
