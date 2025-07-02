@extends('layouts.master')
@section('view-active', 'active')

    @section('body')
        <script>
            initializeDataTable();
        </script>
    
        <section class="bg-light py-5 px-5">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-2" >Nome</th>
                        <th class="col-2">Commento</th>
                        <th class="col-7" >Allegato</th>
                        <th class="col-1">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lucidi as $lucido)
                        <tr>
                            <td>{{ $lucido->titolo }}</td>
                            <td>{{ $lucido->commento }}</td>
                            <td>
                                <iframe src="{{ asset('uploads/' . $lucido->link) }}" style="width: 100%; height: 400px;" frameborder="0"></iframe>
                            </td>
                            <td>
                                <a href="{{ asset('uploads/' . $lucido->link) }}" class="btn btn-primary" download>
                                    <i class="bi bi-download"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        
    @endsection