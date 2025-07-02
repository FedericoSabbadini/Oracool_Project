@extends('layouts.master')

@section('titolo')
@if(isset($author->id))
{{ trans('labels.editAuthor') }}
@else
{{ trans('labels.addAuthor') }}
@endif
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="dropdown active">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Library<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('book.index') }}">@lang('labels.booksList')</a></li>
        <li class='active'><a href="{{ route('author.index') }}">{{ trans('labels.authorsList') }}</a></li>
    </ul>
</li>
@endsection

@section('right_navbar')
<a href="{{ route('setLang', ['lang' => 'en']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/en.png" width="30" class="img-rounded"/></a>
<a href="{{ route('setLang', ['lang' => 'it']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/it.png" width="24" class="img-rounded"/></a>
@if($logged)
<li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
<li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="glyphicon glyphicon-log-out"></span></a></li>
@endif
@endsection

@section('breadcrumb')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active"><a href="{{ route('author.index') }}">My Library</a></li>
<li class="active"><a href="{{ route('author.index') }}">{{ trans('labels.authors') }}</a></li>
@if(isset($author->id))
<li class = "active">{{ trans('labels.editAuthor') }}</li>
@else
<li class = "active">{{ trans('labels.addAuthor') }}</li>
@endif
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class='col-md-12'>
            @if(isset($author->id))
                <form class="form-horizontal" name="author" method="get" action="{{ route('author.update', ['id' => $author->id]) }}">
            @else
                <form class="form-horizontal" name="author" method="post" action="{{ route('author.store') }}">
            @endif
                @csrf
                <div class="form-group">
                    <label for="firstName" class="col-md-2">{{ trans('labels.firstName') }}</label>
                    <div class="col-sm-10">
                        @if(isset($author->id))
                            <input class="form-control" type="text" id="firstName" name="firstName" placeholder="{{ trans('labels.firstAuthorName') }}" value="{{ $author->firstname }}">
                        @else
                            <input class="form-control" type="text" id="firstName" name="firstName" placeholder="{{ trans('labels.firstAuthorName') }}">
                        @endif
                        <span class="invalid-input" id="invalid-firstName"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastName" class="col-md-2">{{ trans('labels.lastName') }}</label>
                    <div class="col-sm-10">
                        @if(isset($author->id))
                            <input class="form-control" type="text" id="lastName" name="lastName" placeholder="{{ trans('labels.lastAuthorName') }}" value="{{ $author->lastname }}">
                        @else
                            <input class="form-control" type="text" id="lastName" name="lastName" placeholder="{{ trans('labels.lastAuthorName') }}">
                        @endif
                        <span class="invalid-input" id="invalid-lastName"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        @if(isset($author->id))
                            <input type="hidden" name="id" value="{{ $author->id }}"/>
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> {{ trans('labels.save') }}</label>
                            <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkAuthor('Save')"/>
                        @else
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> {{ trans('labels.create') }}</label>
                            <input id="mySubmit" type="submit" value="Create" class="hidden" onclick="event.preventDefault(); checkAuthor('Create')"/>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{ route('author.index') }}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> {{ trans('labels.cancel') }}</a>                         
                    </div>
                </div>                       
            </form>
        </div>
    </div>
</div>
@endsection