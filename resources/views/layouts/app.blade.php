<?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
<?php include(app_path()."/lang/". $lang); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="School Management System">
    <meta name="author" content="vdoo.biz">
    <meta name="keyword" content="ngo, website ngo, company create website, website">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Khmer Youth Association Admin Website</title>

     <!-- Chosen  -->
    <link rel="stylesheet" href="{{asset('chosen/chosen.css')}}">
    <!-- Icons -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <script>
        var burl = "{{url('/')}}";
        var asset = "{{asset('img')}}";
    </script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
        <a class="navbar-brand" href="#">KYA Cambodia</a>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>
            <li class="nav-item px-3 text-primary">
                <img src="{{asset('img/flags/UK.png')}}" alt="" width="32">
            </li>
            {{--  <li class="nav-item px-3 text-gray-dark">Branch</li>  --}}

        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('profile/'.Auth::user()->photo)}}" class="img-avatar" alt="">
                    <span class="d-md-down-none text-info">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>{{$lb_account}}</strong>
                    </div>

                    <a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa fa-user text-primary"></i> {{$lb_profile}}</a>
                    <a class="dropdown-item" href="{{url('/user/reset-password')}}"><i class="fa fa-key text-success"></i> {{$lb_reset_password}}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out text-danger"></i> {{$lb_logout}}</a>
                </div>
            </li>
            <li class="nav-item d-md-down-none">
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        </form>
        
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/dashboard')}}"><i class="fa fa-tachometer text-primary"></i> {{$lb_dashboard}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/main-menu')}}"><i class="fa fa-navicon"></i> Main Menu </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/sub-menu')}}"><i class="fa fa-list"></i> Sub Menu </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/slide')}}"><i class="fa fa-picture-o"></i> Slide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/page')}}"><i class="fa fa-columns"></i> Page </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/membership')}}"><i class="fa fa-users"></i> Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/staff')}}"><i class="fa fa-user"></i> Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/post')}}"><i class="fa fa-file-o"></i> Recent News</a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/newsletter')}}"><i class="fa fa-envelope"></i> Newsletter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/announcement')}}"><i class="fa fa-bullhorn"></i> Up Coming Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/case-study')}}"><i class="fa fa-user"></i> Case Study</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/ebook')}}"><i class="fa fa-book"></i> E-Library </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/donor')}}"><i class="fa fa-gift"></i> Donor </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/fm')}}"><i class="fa fa-file text-primary"></i> File Manager </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-key text-danger"></i> {{$lb_security}}</a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a href="{{url('/user')}}" class="nav-link"><i class="fa fa-user text-yellow"></i> {{$lb_user}}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/role')}}" class="nav-link"><i class="fa fa-shield text-info"></i> {{$lb_role}}</a>
                                </li>
                            </ul>
                            
                    </li>

                    {{-- <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa fa-cog text-success"></i> {{$lb_setting}}</a>
                        <ul class="nav-dropdown-items">
                            
                           
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/category')}}"><i class="fa fa-tags"></i>Category</a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <main class="main">
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <footer class="app-footer">
        Copy &copy; {{date('Y')}} by <a href="#">KYA</a>
        <span class="float-right">Powered by <a href="http://vdoo.biz" target="_blank">Vdoo</a>
        </span>
    </footer>
    <!-- Scripts -->
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('bower_components/pace/pace.min.js')}}"></script>
<!-- Plugins and scripts required by all views -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/app1.js') }}"></script>

    @yield('js')
</body>
</html>
