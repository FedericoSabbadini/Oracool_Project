@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('title', 'My online Library')

@section('active_home','active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('body')
<div class="row">
    <div class="col-lg-9 col-sm-12">
        <div class="citazione">
            <p>A very simple example of a website created during the Web Programming 
                and Digital Services course. The site lists the books I am currently 
                reading or have read, along with the list of authors who have populated 
                my readings and imagination. The website will continue to grow during 
                this semester, completing itself gradually thanks to the implementation 
                of web technologies that will be introduced in the course. Enjoy!
            </p>
            <blockquote>
                <p>Sow an act, and you reap a habit; 
                    sow a habit, and you reap a character; 
                    sow a character, and you reap a destiny. </p>
                <small>[Indian proverb]</small>
            </blockquote>
        </div>
    </div>

    <div class="col-lg-3 col-sm-12">
        <div class="imgBiblio">
            <img class="img-thumbnail img-responsive" src="{{ url('/') }}/img/pretty-4-th.jpg">
        </div>
    </div>
</div>
@endsection