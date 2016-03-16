<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pest traps</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    @yield('styles')

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .chart {
            margin: 10px 0;
        }
        .chart-legend {
            list-style: none;
            padding: 0;
        }
        .chart-legend > li {
            float: left;
            margin-right: 10px;
        }
        .chart-legend-marker {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin-right: 5px;
        }
        #gmap {
            margin: 10px 0;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('network.index') }}" style="padding: 0 15px;">
                    <img src="{{ asset('img/aerometer_logo.png') }}" alt="Aerometer" style="height: 100%;" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                @if(\Illuminate\Support\Facades\Auth::check())
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('network.index') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('user.edit',\Illuminate\Support\Facades\Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span> Edit profile</a></li>
                        <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    </ul>
                @else
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('public_home') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    </ul>
                @endif

            </div>

        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery-2.2.0.min.js')  }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>
