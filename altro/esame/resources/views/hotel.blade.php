@extends('layouts.master')
@section('hotel-active', 'active')

    @section('body')
        <script>
            $(document).ready(function() {
                $('#btnClick').click(function(event) {
                    $('form').removeAttr('hidden');
                    $(this).remove();
                });

                $('#form-class').submit(function(event) {
                    event.preventDefault();
                    var punteggio = $('input[name="punteggio"]').val();
                    var error = false;

                    if (punteggio < 1 || punteggio > 5) {
                        $('input[name="punteggio"]').val('');
                        $('input[name="punteggio"]').addClass('is-invalid');
                        $('input[name="punteggio"]').addClass('error-input');
                        $('input[name="punteggio"]').attr('placeholder', '1-5');
                        !error && $('input[name="punteggio"]').focus();
                        error=true;
                    }

                    if (!error) {
                        document.getElementById('form-class').submit();
                    }

                });
            });
        </script>
        <section class="bg-primary text-white text-center py-5">
            <h1 class="display-4">{{ $hotel->nome }} Hotel</h1>
            <br>
            <table class="table table-striped table-bordered container" >
                    <thead>
                        <tr>
                            <th scope="col" class="col-3">Nome</th>
                            <th scope="col" class="col-2">Località</th>
                            <th scope="col" class="col-2">Descrizione</th>
                            <th scope="col" class="col-5">Immagine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $hotel->nome }}</td>
                            <td>{{ $hotel->localita }}</td>
                            <td>{{ $hotel->descrizione }}</td>
                            <td>
                                <img src="{{ asset('uploads/' . $hotel->immagine) }}" style="width: 100%; height: 400px; object-fit: contain;" alt="Immagine Hotel">
                            </td>
                        </tr>
                    </tbody>
            </table>
        </section>

        <section class="bg-light py-5 px-5">
            <h2 class="text-center mb-4">Reviews</h2>
            <table class="table table-bordered table-striped container">
                <thead>
                    <tr>
                        <th>Utente</th>
                        <th>Punteggio</th>
                        <th>Commento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->user }}</td>
                            <td class="text-center">{{ $review->punteggio }}</td>
                            <td>{{ $review->commento }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @php 
                        $userExists = false;

                        foreach($reviews as $review)
                            if ($review->user == Auth::user()->name) {
                                $userExists = true;
                                 break;
                            }
                    @endphp
                    @if (Auth::check() && !$userExists && !Auth::user()->is_admin)
                        <tr>
                            <td colspan="3" class="text-center">
                                <button id="btnClick" class="btn btn-primary">Aggiungi Recensione</button>
                            </td>
                        </tr>
                    @endif
                </tfoot>
            </table>

            <form action="{{ route('hotel.store') }}" method="POST" class="mt-4 container" id="form-class" hidden>
                @csrf
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col-1">Punteggio</th>
                            <th class="col-9">Commento</th>
                            <th class="col-2"> Salva</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="punteggio" class="form-control" placeholder="1-5"></td>
                            <td><textarea name="commento" class="form-control" value="" placeholder="Aggiungi dei commenti ..."></textarea></td>
                            <td>
                                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                <button type="submit" class="btn btn-success">Invia</button>
                            </td>
                        </tr>
                    </tbody>
            </form>
        </section>

        
    @endsection