@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title', 'Biblios :: Books\' List')

@section('active_MyLibrary','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Library</li>
<li class="breadcrumb-item active" aria-current="page">Books</li>
@endsection

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6 d-flex justify-content-end">
            <p>
                <a class="btn btn-success" href="{{ route('book.create') }}">
                    <i class="bi bi-database-add"></i> 
                    Create new book
                </a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <col width='40%'>
                <col width='30%'>
                <col width='10%'>
                <col width='10%'>
                <col width='10%'>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($books_list as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->lastname }}</td>
                            <td><a class="btn btn-secondary" href="{{ route('book.show', ['book' => $book->id]) }}"> Details</a></td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('book.edit',['book' => $book->id]) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('book.destroy.confirm',['id' => $book->id]) }}"><i class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection