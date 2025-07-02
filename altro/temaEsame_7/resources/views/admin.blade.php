@extends('layouts.master')
@section('admin-active', 'active')

    @section('body')
        <script>
            $(document).ready(function() {

                $('#formAddLucido').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    var errorForm = false;
                    var titolo = $('input[name="titolo"]').val();
                    var filePDF = $('input[name="filePDF"]').val();

                    if (titolo.trim() === '') {
                        $('input[name="titolo"]').addClass('error-input');
                        !errorForm && $('input[name="titolo"]').focus();
                        errorForm = true;
                    }
                    if ($('input[type="file"]').get(0).files.length === 0) {
                        $('input[name="filePDF"]').addClass('error-input-val');
                        !errorForm && $('input[name="filePDF"]').focus();
                        errorForm = true;
                    } else if (!filePDF.endsWith('.pdf')) {
                        $('input[name="filePDF"]').addClass('error-input-val');
                        $('input[name="filePDF"]').val('');
                        !errorForm && $('input[name="filePDF"]').focus();
                        errorForm = true;
                    }

                    
                });
            });
        </script>

        <section class="bg-light py-5 px-5">
            <form method="POST" action="{{ route('store.admin') }}"  enctype="multipart/form-data" id="formAddLucido">
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col-3">Titolo</th>
                            <th scope="col-2">File</th>
                            <th scope="col-4">Commento</th>
                            <th scope="col-1">Visible?</th>
                            <th scope="col-2">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="titolo" placeholder="Titolo del file">
                            </td>
                            <td>
                                <input type="file" class="form-control" name="filePDF">
                            </td>
                            <td>
                                <textarea class="form-control" name="commento" placeholder="Commento"></textarea>
                            </td>
                            <td>
                                <input type="checkbox" class="form-check-input" name="isVisible" checked>
                            </td>
                            <td>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </td>

                        </tr>
                    </tbody>

            </form>
        </section>
        
    @endsection