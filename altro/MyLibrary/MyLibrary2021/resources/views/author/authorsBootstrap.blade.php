@extends('layouts.master')

@section('titolo')
{{ trans('labels.authors') }}
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
<li class="active">My Library</li>
<li class="active">{{ trans('labels.authors') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-offset-10 col-xs-6">
            <p>
                <a class="btn btn-success" href="{{ route('author.create') }}"><span class="glyphicon glyphicon-new-window"></span> {{ trans('labels.createNewAuthor') }}</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-hover table-responsive" style="width:100%">
                <col width='80%'>
                <col width='10%'>
                <col width='10%'>
                <thead>
                    <tr>
                        <th>{{ trans('labels.authorName') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($authorList as $author)
                    <tr>
                        <td>{{ $author->firstname }} {{ $author->lastname }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('author.edit', ['author' => $author->id]) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('labels.edit') }}</a>
                        </td>
                        @if(count($author->books)==0)
                        <td>
                            <a class="btn btn-danger" href="{{ route('author.destroy.confirm', ['id' => $author->id]) }}"><span class="glyphicon glyphicon-trash"></span> {{ trans('labels.delete') }}</a>
                        </td>
                        @else
                        <td>
                            <a class="btn btn-default" disabled="disabled" href=""><span class="glyphicon glyphicon-ban-circle"></span> {{ trans('labels.delete') }}</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection