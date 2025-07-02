@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title')
@if(isset($book))
    Biblios :: Edit Book
@else
    Biblios :: Add new book
@endif
@endsection

@section('active_MyLibrary','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('book.index') }}">Library</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('book.index') }}">Books</a></li>
@if(isset($book))
    <li class="breadcrumb-item active" aria-current="page">Edit book</li>
@else
    <li class="breadcrumb-item active" aria-current="page">Add book</li>
@endif
@endsection

@section('body')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(isset($book))
                <form class="form-horizontal" name="book" method="post" action="{{ route('book.update', ['book' => $book->getId()]) }}">
                <!--<input type="hidden" name="_method" value="PUT">-->
                @method('PUT')
                @else
                <form class="form-horizontal" name="book" method="post" action="{{ route('book.store') }}">
                @endif
                @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Title</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($book))
                                <input class="form-control" type="text" name="title" value="{{ $book->getTitle() }}"/>
                            @else
                                <input class="form-control" type="text" name="title"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="author_id">Author</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="author_id">
                                @foreach($authorList as $author)
                                    @if((isset($book))&&($author->getId() == $book->getAuthorID()))
                                        <option value="{{ $author->getId() }}" selected="selected">{{ $author->getLastName() }}</option>
                                    @else
                                        <option value="{{ $author->getId() }}">{{ $author->getLastName() }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            @if(isset($book))
                                <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Save</label>
                                <input id="mySubmit" class="d-none" type="submit" value="Save"/>
                            @else
                                <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i> Create</label>
                                <input id="mySubmit" class="d-none" type="submit" value="Create"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <a class="btn btn-danger w-100" href="{{ route('book.index') }}"><i class="bi bi-box-arrow-left"></i>
                                Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection