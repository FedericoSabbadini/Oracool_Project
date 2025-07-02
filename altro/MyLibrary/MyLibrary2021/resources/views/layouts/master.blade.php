<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('titolo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
    <!-- jQuery e plugin JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/js/myScript.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</head>

<body>
    <nav class="navbar-default">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Devis Bianchini</a>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    @yield('left_navbar')
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @yield('right_navbar')
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <ul class="breadcrumb pull-right">
            @yield('breadcrumb')
        </ul>
    </div>

    <div class="container">
        <header class="header-sezione">
            <h1>
                @yield('titolo')
            </h1>
        </header>
    </div>

    @yield('corpo')
</body>

</html>