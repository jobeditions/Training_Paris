<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->
    <link rel="icon" href="/frontoffice/img/logo-dark.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/frontoffice/favicon.ico" type="image/x-icon" />
    <title>TeacherHawk - @yield('page_name')</title>
    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/teacheroffice/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/teacheroffice/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="/teacheroffice/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- jQuery -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
@yield('css')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header"><a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
                                      data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part"><a class="logo" href="{{ url('admin') }}"><img
                            src="/teacheroffice/img/logo.png" alt="home" style="max-height:60px;"/></span></a></div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i
                                class="icon-arrow-left-circle ti-menu"></i></a></li>

            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown"><a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                                        href="#"><i class="icon-note"></i>
                        @if( count(Auth::user()->unreadNotifications)>0)
                            <div class="notify">
                                <span class="heartbit"></span>
                                <span class="point"></span>
                            </div>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-tasks scale-up">
                        @foreach(Auth::user()->unreadNotifications as $notification)
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>{{ $notification->data['content'] }}</strong>
                                            <span class="pull-right text-muted">{{ $notification->created_at }}</span>
                                        </p>
                                    </div>
                                </a>
                            </li>

                            <li class="divider"></li>

                        @endforeach
                        <li>
                            <a class="text-center" href="{{ url('teacher/notifications') }}"> <strong>Voir toutes les
                                    notifications</strong> <i
                                        class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li>
                    <a class="dropdown-toggle profile-pic" href="#"> <img
                                src="https://s3.amazonaws.com/uifaces/faces/twitter/k/128.jpg" alt="user-img" width="36"
                                class="img-circle"><b
                                class="hidden-xs">{{ Auth::user()->name }}</b> </a>
                </li>

                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">
                <li class="user-pro">
                    <a href="#" class="waves-effect"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/k/128.jpg" alt="user-img"
                                                          class="img-circle"> <span
                                class="hide-menu">{{ Auth::user()->name }} </span>
                    </a>

                </li>


                <li class="nav-small-cap">-- Menu</li>
                <li><a href="{{ route('admin-classrooms') }}" class="waves-effect"><i
                                class="zmdi zmdi-accounts-list zmdi-hc-fw fa-fw"></i>
                        <span class="hide-menu">Classes</span></a></li>
                <li><a href="#" class="waves-effect"><i
                                class="zmdi zmdi-account-add zmdi-hc-fw fa-fw"></i>
                        <span class="hide-menu">Invitations</span></a></li>
                <li class="nav-small-cap">-- Compte</li>

                <li><a href="#" class="waves-effect"><i
                                class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i>
                        <span class="hide-menu">Paramètres</span></a></li>


                <li><a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" class="waves-effect"><i
                                class="zmdi zmdi-power zmdi-hc-fw fa-fw"></i> <span
                                class="hide-menu">Déconnexion</span></a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>


            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">@yield('page_name')</h4></div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">@yield('page_name') </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @yield('content')
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center">&copy; 2017 <a href="https://liigem.io">Liigem</a> - <a
                    href="{{url('teacher/version')}}">Version</a></footer>

    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="/teacheroffice/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="/teacheroffice/js/waves.js"></script>
<!--weather icon -->
<script src="/bower_components/skycons/skycons.js"></script>
<!--Counter js -->
<script src="/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="/bower_components/raphael/raphael-min.js"></script>
<script src="/bower_components/morrisjs/morris.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/teacheroffice/js/custom.min.js"></script>
<script src="/teacheroffice/js/dashboard4.js"></script>
<!-- Sparkline chart JavaScript -->
<script src="/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!--Style Switcher -->
<script src="/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<!-- Local change -->
<script src="/teacheroffice/js/teacher.js"></script>
@yield('javascript')
</body>

</html>
