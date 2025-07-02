@extends('layouts.master')
@section('home-active', 'active')

    @section('body')
        <script>
            initializeDataTable(tableId = 'dataTable', {
                pageLength: 10,
                order: [[2, 'asc']],
            });
        </script>

        <section class="bg-primary text-white text-center py-5">
                
        </section>

        <section class="bg-light py-5 px-5">

        </section>
        
    @endsection