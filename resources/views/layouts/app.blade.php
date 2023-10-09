<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CNHS') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/data_tables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/guestannouncement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/events.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/guest_welcome.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/news.css') }}">
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/view_event.css') }}">
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/department.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_class.css') }}">
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/view_news.css') }}">
</head>

<body>
    <div id="app">
        <header class="header_authenticated" style="position: fixed; z-index: 999;">
            <nav class="navbar">
                <a class="navbar-brand" href="{{ route('HomePage') }}">
                    <img src="{{ asset('images/logo.png') }}" width="100" height="100" alt="logo">
                    <b>CAN-AVID NATIONAL HIGH SCHOOL</b>
                </a>
                <div class="topnav" id="myTopnav">
                    <div class="dropdown">
                        <button id="navbar-dropdown" class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            About CNHS
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('guestannouncement') }}">Announcements</a>
                            <a class="dropdown-item" href="{{ route('display_events') }}">Events</a>
                            <a class="dropdown-item" href="{{ route('guest_career') }}">Careers</a>
                            <a class="dropdown-item" href="{{ route('display_departments') }}">Departments</a>
                            <a class="dropdown-item" href="{{ route('guest_chart') }}">Organizational Chart</a>
                            <a class="dropdown-item" href="#">Admission</a>
                            <a class="dropdown-item" href="{{ route('school-calendar') }}">School Calendar</a>
                        </div>
                        <a class="navigation" href="{{ route('sidenav') }}">ADMINISTER</a>
                        <a class="navigation" href="#contact_us">CONTACT US</a>
                        <div class="navigation">
                            <div class="user-profile">
                                <img src="{{ asset('storage/' . Auth::guard('web')->user()->profile->images) }}"
                                    alt="User Profile Image"
                                    style="max-width: 50px; max-height: 50px; border-radius: 50%;">
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
        @if (View::hasSection('sidenav'))
            <div class="menu_class">
                @yield('sidenav')
            </div>
        @endif
        <footer class="footer">
            <p>&copy; 2023 Can-avid National High School Property. All Rights Reserved.</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".burger-menu-button").click(function() {
                    $(".burger-menu").slideToggle(); // Toggle the display of the burger menu
                });
            });
        </script>
    </div>
</body>

</html>
