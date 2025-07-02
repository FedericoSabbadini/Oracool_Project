@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title', 'Biblios :: Book details')

@section('active_MyLibrary','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('book.index') }}">Library</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('book.index') }}">Books</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-10">
        <div class="row mb-3">
            <div class="col-md-3">
                <b>Title:</b>
            </div>
            <div class="col-md-9">
                {{ $book->title }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <b>Author:</b>
            </div>
            <div class="col-md-9">
                {{ $book->author->lastname }}, {{ $book->author->firstname }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <b>Categories:</b>
            </div>
            <div class="col-md-8">
            @foreach($book->categories as $cat)
                <div>{{ $cat->name }}</div>
            @endforeach                    
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="row mb-3">
            <div class="col-md-12">
                <a class="btn btn-primary w-100" href="{{ route('book.edit', ['book' => $book->id]) }}"><i class="bi bi-pencil-square"></i> Edit</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <a class="btn btn-danger w-100" href="{{ route('book.destroy.confirm', ['id' => $book->id]) }}"><i class="bi bi-trash"></i> Delete</a>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <a class="btn btn-secondary w-100" href="{{ route('book.index') }}"><i class="bi bi-box-arrow-left"></i> Back</a>
    </div>
        
</div>
@endsection