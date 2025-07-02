<!DOCTYPE html>
<htm>
    <head>
        <meta charset="UTF-8">
        <title>User authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="container text-center">
            <div class="row" style="margin-top: 4em;">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-danger">
                            <div class='panel-heading'>
                                {{ trans('labels.authError') }}
                            </div>
                            <div class='panel-body'>
                                <p>{{ trans('labels.wrongCredentialsMessage') }}</p>
                                <p><a class="btn btn-default" href="{{ route('home') }}"><span class='glyphicon glyphicon-log-out'></span> {{ trans('labels.backHome') }}</a></p>
                                <p><a href="#">{{ trans('labels.forgotPassword') }}</a></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>        
    </body>
</htm>