@extends('dashboard.dashboard')

@section('menu')
    <div class="menu_class">
        <div class="sidenav" style="margin-top: 50px;">
            @if (Auth::user()->role === 'Admin')
                <a class="menu" id="menu1" href="{{ route('users.index') }}">Users</a>
                <a class="menu" href="{{ route('careers.index') }}">Careers</a>
                <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
                <a class="menu" href="{{ route('requests.index') }}">Requested School Form</a>
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
        </div>
        <div class="p-3 md-10 bg-white rounded">
            @yield('sub-content')
        </div>
    </div>
    @endsection
