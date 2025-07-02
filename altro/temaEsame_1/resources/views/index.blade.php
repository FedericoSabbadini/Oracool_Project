@extends ('layouts.master')

@section('home-active', 'active')

@section('content')
    <section class="bg-light py-5 px-5">
        <table class="table table-striped table-bordered" id="dataTable">
            <thead>
                <tr>
                        <th  class="col-3">Data Appello</th>
                        <th  class="col-1">Matricola</th>
                        <th  class="col-3">Cognome</th>
                        <th class="col-2" >Nome</th>
                        <th  class="col-3">Voto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($student->dataAppello)->format('Y-m-d') }}</td>
                    <td>{{ $student->numMatricola }}</td>
                    <td>{{ $student->cognome }}</td>
                    <td>{{ $student->nome }}</td>
                    <td>{{ $student->voto }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection