<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TeacherHawk</title>

    <!-- Favicon -->
    <link rel="icon" href="/frontoffice/img/logo-dark.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/frontoffice/favicon.ico" type="image/x-icon" />

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/students/css/style.css" rel="stylesheet">
@yield('css')

    <!-- Scripts -->
    <script src="/frontoffice/vendor/jquery-2.2.1.min.js"></script>
    <script src="/students/js/Chart.min.js"></script>
    <script src="/students/js/student.js"></script>
    <script>
        window.Laravel =; <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="/js/app.js"></script>
</head>
<body>

<nav class="navbar navbar-no-margin navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/student') }}">
                    <img src="/teacheroffice/img/logo.png" height="25" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else

                            <li class="{{ Request::is('student') ? 'active' : '' }}"><a href="{!! action('StudentController@index') !!}">Résumé</a></li>
                        <li class="{{ Request::is('student/notes') ? 'active' : '' }}"><a
                                    href="{{ url('student/notes') }}">Mes notes</a></li>
                            <li class="{{ Request::is('student/assignments') ? 'active' : '' }}"><a href="{!! action('AssignmentController@index') !!}">Mes devoirs</a></li>
                            <li class="{{ Request::is('student/exams') ? 'active' : '' }}"><a href="{!! action('ExamController@index') !!}">Mes interrogations</a></li>
                            <li class="{{ Request::is('student/teachers') ? 'active' : '' }}"><a href="{!! action('TeacherForStudentController@index') !!}">Mes professeurs</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ url('storage/avatars/'.Auth::user()->avatar) }}" height="25"
                                         class="img-circle"/>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a href="{{ url('/student/settings') }}">
                                            <i class="icon-user"></i> Paramètres
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     Déconnexion
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

<ol class="breadcrumb">
    <li><a href="/student">Accueil</a></li>
    <li class="active">@yield('pagename')</li>
</ol>

    @yield('content')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
