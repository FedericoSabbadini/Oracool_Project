@extends('layouts.master')
@section('load-active', 'active')

@section('body')

    <script>
        $(document).ready(function() {

            $('#load-form').on('submit', function(event) {
                event.preventDefault(); 

                let titolo = $('input[name="titolo"]').val();
                let filePDF = $('input[name="filePDF"]').val();
                var error = false;

                if( titolo.trim() == '') {
                    $('#error-titolo').removeAttr('hidden');
                    !error && $('input[name="titolo"]').focus();
                    error = true;
                } else {
                    $('#error-titolo').attr('hidden', true);
                }

                if( filePDF.trim() == '') {
                    $('#error-file').removeAttr('hidden');
                    !error && $('input[name="filePDF"]').focus();
                    error = true;
                } else if (!filePDF.endsWith('.pdf')) {
                    $('#error-file').attr('hidden', true);
                    $('#error-file-pdf').removeAttr('hidden');
                    $('input[name="filePDF"]').val(''); 
                    error = true;
                } else {
                    $('#error-file-pdf').attr('hidden', true);
                }

                if (!error) {
                    this.submit(); 
                }
            });

        });
    </script>

    <section class="bg-light py-5 px-5">
        <div class="container">
            <h1 class="mb-4">Carica Lucidi</h1>
            <form action="{{ route('load.store') }}" id="load-form" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-2">Titolo</th>
                        <th class="col-4">File</th>
                        <th class="col-4">Commento</th>
                        <th class="col-1">Visibile?</th>
                        <th class="col-1">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="titolo" class="form-control" placeholder="Inserisci il titolo" >
                            <span hidden class="text-danger" id="error-titolo">Titolo vuoto!</span>
                        </td>
                        <td>
                            <input type="file" name="filePDF" class="form-control">
                            <span hidden class="text-danger" id="error-file">File PDF vuoto!</span>
                            <span hidden class="text-danger" id="error-file-pdf">File non PDF!</span>
                        </td>
                        <td>
                            <textarea name="commento" class="form-control" placeholder="Inserisci i commenti ..." value=""></textarea>
                        </td>
                        <td>
                            <input type="checkbox" name="isVisible" value="1" checked>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i>
                            </button>
                            <button type="reset" class="btn btn-secondary ml-2">
                                <i class="fas fa-eraser"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </section>
    
@endsection