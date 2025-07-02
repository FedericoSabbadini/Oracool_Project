@extends('layouts.delete')

@section('titolo', 'Delete book from the list')

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
<li class="active">{{ trans('labels.deleteBook') }}</li>
@endsection

@section('corpo')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <header>
                <h1>
                    {{ trans('labels.deleteBookMsgFirstPart') }} "{{ $book->title }}" {{ trans('labels.deleteBookMsgFirstPart') }}
                </h1>
            </header>
            <p class='lead'>
                {{ trans('labels.confirmDeleteAuthorMsg') }}
            </p>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class='panel-heading'>
                    {{ trans('labels.revert') }}
                </div>
                <div class='panel-body'>
                    <p>{{ trans('labels.deleteBookRevertMsgFirstPart') }} <strong>{{ trans('labels.deleteBookRevertMsgStrongPart') }}</strong> {{ trans('labels.deleteBookRevertMsgLastPart') }}</p>
                    <p><a class="btn btn-default" href="{{ route('book.index') }}"><span class='glyphicon glyphicon-log-out'></span> {{ trans('labels.backBookList') }}</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class='panel-heading'>
                    {{ trans('labels.confirm') }}
                </div>
                <div class='panel-body'>
                    <p>{{ trans('labels.deleteBookConfirmMsgFirstPart') }} <strong>{{ trans('labels.deleteBookConfirmMsgStrongPart') }}</strong> {{ trans('labels.deleteBookConfirmMsgLastPart') }}</p>
                    <p><a class="btn btn-danger" href="{{ route('book.destroy', ['id' => $book->id]) }}"><span class='glyphicon glyphicon-trash'></span> {{ trans('labels.delete') }}</a></p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection