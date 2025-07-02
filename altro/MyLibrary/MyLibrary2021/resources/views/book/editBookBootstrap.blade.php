@extends('layouts.master')

@section('titolo')
@if(isset($book->id))
    {{ trans('labels.editBook') }}
@else
    {{ trans('labels.addBook') }}
@endif
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="dropdown active">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Library<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class='active'><a href="{{ route('book.index') }}">@lang('labels.booksList')</a></li>
        <li><a href="{{ route('author.index') }}">{{ trans('labels.authorsList') }}</a></li>
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
<li class="active"><a href="{{ route('book.index') }}">My Library</a></li>
<li class="active"><a href="{{ route('book.index') }}">{{ trans('labels.books') }}</a></li>
@if(isset($book->id))
    <li class = "active">{{ trans('labels.editBook') }}</li>
@else
    <li class = "active">{{ trans('labels.addBook') }}</li>
@endif
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class='col-md-12'>
            @if(isset($book->id))
                <form class="form-horizontal" name="book" method="get" action="{{ route('book.update', ['id' => $book->id]) }}">
            @else
                <form class="form-horizontal" name="book" method="post" action="{{ route('book.store') }}">
            @endif
                @csrf
                <div class="form-group">
                    <label for="title" class="col-md-2">{{ trans('labels.bookTitle') }}</label>
                    <div class="col-sm-10">
                        @if(isset($book->id))
                        <input class="form-control" type="text" id="title" name="title" placeholder="{{ trans('labels.bookTitle') }}" value="{{ $book->title }}">
                        @else
                        <input class="form-control" type="text" id="title" name="title" placeholder="{{ trans('labels.bookTitle') }}">
                        @endif
                        <span class="invalid-input" id="invalid-title"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="author_id" class="col-md-2">{{ trans('labels.bookAuthor') }}</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="author_id">
                            @foreach($authorList as $author)
                                @if((isset($book->id))&&($author->id == $book->author_id))
                                    <option value="{{ $author->id }}" selected="selected">{{ $author->lastname }}</option>
                                @else
                                    <option value="{{ $author->id }}">{{ $author->lastname }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        @if(isset($book->id))
                        <input type="hidden" name="id" value="{{ $book->id }}"/>
                        <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> {{ trans('labels.save') }}</label>
                        <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkBook('Save')"/>
                        @else
                        <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> {{ trans('labels.create') }}</label>
                        <input id="mySubmit" type="submit" value="Create" class="hidden" onclick="event.preventDefault(); checkBook('Create')"/>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{ route('book.index') }}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> {{ trans('labels.cancel') }}</a>                         
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection