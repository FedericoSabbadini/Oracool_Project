@extends('layouts.master')
@section('view-active', 'active')

@section('body')
    <script>
        initializeDataTable(tableId = 'dataTable', {
            pageLength: 1,
        });
    </script>

    <section class="bg-light py-5 px-5">
        <div class="container">
            <h1 class="mb-4">Carica Lucidi</h1>
            <form action="{{ route('view.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th class="col-2">Titolo</th>
                        <th class="col-4">File</th>
                        <th class="col-4">Commento</th>
                        <th class="col-1">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lucidi as $lucido)
                    <tr>
                        <td>
                            {{ $lucido->titolo }}
                        </td>
                        <td>
                            <iframe src="{{ asset('uploads/' . $lucido->percorso) }}" width="100%" height="300px" frameborder="0"></iframe>
                        </td>
                        <td>
                            {{ $lucido->commento }}
                        </td>
                        <td>
                            <a href="{{ asset('uploads/' . $lucido->percorso) }}" class="btn btn-primary" download>
                                <i class="fas fa-download"></i>
                                
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </section>
    
@endsection