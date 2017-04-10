<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap-datepaginator.css" rel="stylesheet">
    <link href="/vendor/bootstrap-datepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.0/jquery-migrate.js"></script>
    <script src="/js/moment.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/bootstrap-datepaginator.js"></script>
    <script src="/vendor/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>


    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                @if (!(Auth::guest()))
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{url('/timesheets')}}">Timesheets</a></li>
                    @if(Auth::user()->hasRole(2))
                        <li><a href="{{url('/projects')}}">Projects</a></li>
                        <li><a href="{{url('/admin/showUsers')}}">Users</a></li>
                        <li><a href="{{url('/admin/showDepartments')}}">Departments</a></li>
                        <li><a href="{{url('/admin/showCategories')}}">Categories</a></li>
                    @elseif(Auth::user()->hasRole(3))

                    @else
                        <li><a href="{{url('/projects')}}">Projects</a></li>
                        <li><a href="{{url('/admin/showDepartments')}}">Departments</a></li>
                        <li><a href="{{url('/admin/showUsers')}}">Users</a></li>
                        <li><a href="{{url('/admin/showCategories')}}">Categories</a></li>
                        <li><a href="{{url('/admin/showClients')}}">Clients</a></li>
                    @endif
                </ul>
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Scripts -->




</body>
</html>
