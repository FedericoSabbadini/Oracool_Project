@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title', 'Biblios :: Author\'s details')

@section('active_MyLibrary','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('author.index') }}">Library</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('author.index') }}">Authors</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $author->firstname }} {{ $author->lastname }}</li>
@endsection

@section('body')
<div class="row">
    <div class="col-md-10">
        <div class="row mb-3">
            <div class="col-md-3">
                <b>Lastname:</b>
            </div>
            <div class="col-md-9">
                {{ $author->lastname }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <b>Firstname:</b>
            </div>
            <div class="col-md-9">
                {{ $author->firstname }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <b>Address:</b>
            </div>
            <div class="col-md-9">
                {{ $author->address->street_and_number }} - {{ $author->address->postcode }} {{ $author->address->city }} ({{ $author->address->province }}, {{ $author->address->country }})
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="row mb-3">
            <div class="col-md-12">
                <a class="btn btn-primary w-100" href="{{ route('author.edit', ['author' => $author->id]) }}"><i class="bi bi-pencil-square"></i> Edit</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                @if(count($author->books)==0)
                    <a class="btn btn-danger w-100" href="{{ route('author.destroy.confirm', ['id' => $author->id]) }}"><i class="bi bi-trash"></i> Delete</a>
                @else
                    <a class="btn btn-secondary w-100" disabled="disabled" href="#"><i class="bi bi-ban"></i> Delete</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <a class="btn btn-secondary w-100" href="{{ route('author.index') }}"><i class="bi bi-box-arrow-left"></i> Back</a>
    </div>
        
</div>
@endsection