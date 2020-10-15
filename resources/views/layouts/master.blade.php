<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto"></ul>
        </nav>

        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <a href="{{ route('index') }}" class="brand-link">
                <img src="https://logo.clearbit.com/appcast.io" alt="AdminLTE Logo" class="brand-image rounded-circle"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">
                <div class="user-panel my-4 pb-4 d-flex">
                    <div class="image">
                        <img src="{{ auth()->user()->profile_photo_url }}" class="rounded-circle" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header text-muted">Manage Account</li>
                        <li class="nav-item">
                            <a href="{{ route('profile.index') }}" class="nav-link {{ linkActiveClass('profile') }}">
                                <i class="nav-icon fas fa-user-circle my-1"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon my-1 fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon my-1"></i>
                                        <p>Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon my-1"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-power-off my-1"></i>
                                <p>Logout</p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark text-capitalize">{{ request()->segment(1)  }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="main-footer text-sm">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
@stack('script')
</body>
</html>
