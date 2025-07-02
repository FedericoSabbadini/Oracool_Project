@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title')
@if(isset($author))
    Biblios :: Edit Author
@else
    Biblios :: Add new author
@endif
@endsection

@section('active_MyLibrary','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('author.index') }}">Library</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('author.index') }}">Authors</a></li>
@if(isset($author))
    <li class="breadcrumb-item active" aria-current="page">Edit author</li>
@else
    <li class="breadcrumb-item active" aria-current="page">Add author</li>
@endif
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(isset($author))
                <form name="author" method="post" action="{{ route('author.update', ['author' => $author->id]) }}">
                <!--<input type="hidden" name="_method" value="PUT">-->
                @method('PUT')
                @else
                <form class="form-horizontal" name="author" method="post" action="{{ route('author.store') }}">
                @endif
                @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">First Name</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($author))
                                <input class="form-control" type="text" name="firstName" placeholder="Author's First Name" value="{{ $author->firstname }}">
                            @else
                                <input class="form-control" type="text" name="firstName" placeholder="Author's First Name">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Last Name</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($author))
                                <input class="form-control" type="text" name="lastName" placeholder="Author's Last Name" value="{{ $author->lastname }}">
                            @else
                                <input class="form-control" type="text" name="lastName" placeholder="Author's Last Name">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            @if(isset($author))
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
                            <a class="btn btn-danger w-100" href="{{ route('author.index') }}"><i class="bi bi-box-arrow-left"></i>
                                Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection