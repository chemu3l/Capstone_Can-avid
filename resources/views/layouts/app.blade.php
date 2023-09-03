<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/facilitator_welcome.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-white bg-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" width="100" height="100" alt="logo">
                    <b>CAN-AVID NATIONAL HIGH SCHOOL</b>
                </a>
                <div class="topnav" id="myTopnav">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                            About CNHS
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#announcements">Announcements</a>
                            <a class="dropdown-item" href="#">Careers</a>
                            <a class="dropdown-item" href="#">Alumni</a>
                            <a class="dropdown-item" href="#">Departments</a>
                            <a class="dropdown-item" href="{{ route('guest_chart')}}">Organizational Chart</a>
                            <a class="dropdown-item" href="#">Admission</a>
                        </div>
                        @if (Auth::user()->role === 'Admin')
                            <a class="navigation" href="{{ route('users.index') }}">ADMINISTER</a>
                        @elseif(Auth::user()->role === 'Principal')
                            <a href="{{ route('events_table') }}" class="btn btn-primary">ADMINISTER</a>
                        @else
                            <a href="{{ route('events_table') }}" class="btn btn-primary">ADMINISTER</a>
                        @endif
                        <a class="navigation" href="#contact_us">CONTACT US</a>
                        <div class="navigation">
                            <div class="user-profile">
                                <a id="name" href="#name">{{ Auth::guard('web')->user()->profile->name }}</a>
                                <div class="hover-menu">
                                    <ul>
                                        <li><a href="{{ route('setting') }}">Options</a></li>
                                        <li><a href="{{ route('logout') }}">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
    <div class="container">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
            @auth
                @yield('sidenav')
            @endauth
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

</body>

</html>
