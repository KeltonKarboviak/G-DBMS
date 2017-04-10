<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.min.css" integrity="sha256-BQ3m8birKYRzXjofYJeErdZ/SMsXgOoBPXt0d6c3FZc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}" />

    <!-- Allows for page-specific CSS to be inserted here -->
    @yield('styles')

    <style>
        body {
            font-family: 'Lato';
            margin-top: 75px;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-fixed-top">
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
                <a class="navbar-brand" href="{{ url('/home') }}">
                    G-DBMS
                </a>
            </div>

            
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @if(Auth::check())
                    <?php $role = Auth::user()->role->name; ?>
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Student <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/student') }}">Info</a></li>
                                @if($role == 'Director' || $role == 'Secretary')
                                    <li><a href="{{ url('/student/add') }}">Add</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Advisor <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/advisor') }}">Info</a></li>
                                @if($role == 'Director')
                                    <li><a href="{{ url('/advisor/add') }}">Add</a></li>
                                @endif
                            </ul>
                        </li>
                        @if($role == 'Director' || $role == 'Chair')
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">GQE <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/gqe/result') }}">Result</a></li>
                                    <li><a href="{{ url('/gqe/offering') }}">Offering</a></li>
                                    <li><a href="{{ url('/gqe/section') }}">Section</a></li>
                                    <li><a href="{{ url('/gqe/passlevel') }}">Pass Level</a></li>
                                </ul>
                            </li>
                        @endif
                        @if($role == 'Director')
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">GCE <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/gce/add') }}">Add</a></li>
                                </ul>
                            </li>
                        @endif
                        @if($role == 'Director' || $role == 'Chair')
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Assistantships <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/assistantship/') }}">Info</a></li>
                                    @if($role == 'Director')
                                        <li><a href="{{ url('/assistantship/add') }}">Add</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->first_name . " " . Auth::user()->last_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if($role == 'Director')
                                    <li><a href="{{ url('/register') }}">Register new user</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="{{ elixir('js/app.js') }}"></script>

    <!-- Allows for page-specific JavaScript to be inserted here -->
    @yield('scripts')

</body>
</html>
