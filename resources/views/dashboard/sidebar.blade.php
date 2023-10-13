@extends('dashboard.dashboard')

@section('menu')
    <div class="menu_class">
        <div class="headers_textTitle">
            @if (Auth::user()->role == 'Admin')
                Admin Dashboard
            @elseif (Auth::user()->role == 'Principal')
                Principal Dashboard
            @elseif (Auth::user()->role == 'Registrar')
                Registrar Dashboard
            @else
                Faculty/Staff Dashboard
            @endif
        </div>
        <div class="sidenav" style="margin-top: 50px;">
            @if (Auth::user()->role === 'Admin')
                <a class="menu" id="menu1" href="{{ route('users.index') }}">Users</a>
                <a class="menu" href="{{ route('careers.index') }}">Careers</a>
                <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
                <a class="menu" href="{{ route('organizational_chart.index') }}">Organizational Chart</a>
                <a class="menu" href="{{ route('logs.index') }}">Logs</a>
            @endif
            <a class="menu" href="{{ route('news.index') }}">News</a>
            <a class="menu" href="{{ route('announcements.index') }}">Announcements</a>
            <a class="menu" href="{{ route('events.index') }}">Events</a>
            @if (Auth::user()->role === 'Principal' || Auth::user()->role === 'Registrar')
                <a class="menu" href="{{ route('careers.index') }}">Careers</a>
                <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
                <a class="menu" href="{{ route('requests.index') }}">Requested School Form</a>
                <a class="menu" href="{{ route('organizational_chart.index') }}">Organizational Chart</a>
                <a class="menu" href="#feedback">Feedback</a>
            @endif
            <a class="menu" href="{{ route('history') }}">History</a>
            <div class="navigation">
                <center>
                    <div class="user-profile">
                        <img src="{{ asset('storage/' . Auth::guard('web')->user()->profile->images) }}"
                            alt="User Profile Image" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                        <a id="name" href="#name">{{ Auth::guard('web')->user()->profile->name }}</a>
                        <div class="hover-menu">
                            <ul>
                                <li><a href="{{ route('setting') }}">Options</a></li>
                                <li><a href="{{ route('logout') }}">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </center>
            </div>
        </div>
        <div class="p-3 md-10 bg-white rounded">
            @yield('sub-content')
        </div>
    </div>
@endsection
