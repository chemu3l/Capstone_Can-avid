@extends('layouts.app')

@section('sidenav')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/admin_dashboard.css') }}">
    <div class="sidenav">
        <a class="navbar-brand" href="{{ route('home') }}">
            <figure class="figure">
                &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('images/logo.png') }}" width="100" height="100"
                    alt="A generic square placeholder image with rounded corners in a figure.">
                <figcaption class="text-sm"><span>&nbsp;&nbsp;CAN-AVID NATIONAL
                        HIGH
                </figcaption>
            </figure>
        </a>
        @if (Auth::user()->role === 'Admin')
            <a class="menu" id="menu1" href="{{ route('users.index') }}">Users</a>
            <a class="menu" href="{{ route('careers.index') }}">Careers</a>
            <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
            <a class="menu" href="#Request">Requested School Form</a>
            <a class="menu" href="{{ route('alumnis.index') }}">Alumni</a>
            <a class="menu" href="{{ route('organizational_chart.index') }}">Organizational Chart</a>
            <a class="menu" href="{{ route('calendar') }}">School Calendar</a>
        @endif
        <a class="menu" href="{{ route('news.index') }}">News</a>
        <a class="menu" href="{{ route('announcements.index') }}">Announcements</a>
        <a class="menu" href="{{ route('events.index') }}">Events</a>
        @if (Auth::user()->role === 'Principal' || Auth::user()->role === 'Registrar')
            <a class="menu" href="{{ route('careers.index') }}">Careers</a>
            <a class="menu" href="#applicant">Applicant</a>
            <a class="menu" href="#Request">Requested School Form</a>
            <a class="menu" href="#alumni">Alumni</a>
            <a class="menu" href="#organizational">Organizational Chart</a>
            <a class="menu" href="#calendar">School Calendar</a>
        @endif
        <a class="menu" href="{{ route('history')}}">History</a>
        <a class="menu" href="#feedback">Feedback</a>
        <a class="menu" href="#logs">Logs</a>
        {{-- <div class="dropdown" id="menu2">
                <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    {{ Auth::guard('web')->user()->profile->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- Dropdown menu items -->
                    <a class="dropdown-item" href="{{ route('setting') }}">Options</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div> --}}
        </a>
    </div>
    <div class="main-content">
        @yield('content')
        <div class="shadow-lg p-3 mb-5 bg-white rounded">
            @yield('sub-content')
        </div>
    </div>
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
@endsection
