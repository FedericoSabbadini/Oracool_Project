@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title', 'Biblios :: Authors\' List')

@section('active_MyLibrary','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Library</li>
<li class="breadcrumb-item active" aria-current="page">Authors</li>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 d-flex justify-content-end">
                <p>
                    <a class="btn btn-success" href="{{ route('author.create') }}">
                        <i class="bi bi-database-add"></i>
                        Create new author</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-responsive">
                    <col width='80%'>
                    <col width='10%'>
                    <col width='10%'>
                    <thead>
                        <tr>
                            <th>Author's name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($authors_list as $author)
                            <tr>
                                <td>{{ $author->firstname }} {{ $author->lastname }}</td>
                                <td><a class="btn btn-primary" href="{{ route('author.edit',['author' => $author->id]) }}"><i class="bi bi-pencil-square"></i> Edit</a></td>
                                @if(count($author->books)==0)
                                    <td><a class="btn btn-danger" href="{{ route('author.destroy.confirm', ['id' => $author->id]) }}"><i class="bi bi-trash"></i> Delete</a></td>
                                @else
                                    <td><a class="btn btn-secondary" disabled="disabled" href="#"><i class="bi bi-ban"></i> Delete</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection