@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Error 500</li>
@endsection

@section('body')

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-danger">
                <div class='card-header'>
                    <b>Illegal page access:</b> something <strong>wrong</strong> happened while accessing this page!
                </div>
                <div class='card-body'>
                    <p>Error 500 - Internal server error. Please contact the administrator.</p>
                    <p><a class="btn btn-danger" href="{{ route('home') }}"><i class="bi bi-box-arrow-left"></i> Back to home!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection