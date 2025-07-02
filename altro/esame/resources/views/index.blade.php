@extends('layouts.master')
@section('home-active', 'active')

    @section('body')

        <section class="bg-light py-5 px-5">
            <table class="table table-bordered table-striped container">
                <thead>
                    <tr>
                        <th class="col-6">Nome</th>
                        <th class="col-6">Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $hotel)
                        <tr>
                            <td>{{ $hotel->nome }}</td>
                            <td>
                                <a href="{{ route('hotel.show', ['id' => $hotel->id]) }}" class="btn btn-info">Visualizza</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        
    @endsection