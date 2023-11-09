@extends('layouts.app')

@section('content')
    <header>
        <div class="container_management">
            <div class="sec1">
                <p class="heading_management">Welcome, {{ Auth::user()->profile->name }}</p>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
            </div>
        </div>
    </header>

    <section>
        <div class="main_management">
            <div class="sub1">
                <ul class="ul_management">
                    <li><a href="{{ route('announcements.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                <path
                                    d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                            </svg>&nbsp;&nbsp;&nbsp;&nbsp;Announcements</a></li>
                    <li><a href="{{ route('news.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z" />
                                <path
                                    d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z" />
                            </svg>&nbsp;&nbsp;&nbsp;&nbsp;News</a></li>
                    <li><a href="{{ route('events.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-calendar2-event" viewBox="0 0 16 16">
                                <path
                                    d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                <path
                                    d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                            </svg> &nbsp;&nbsp;&nbsp;&nbsp;Events</a></li>
                    <li><a href="{{ route('history') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                <path
                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                <path
                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                            </svg> &nbsp;&nbsp;&nbsp;&nbsp;History</a></li>
                    @if (Auth::user()->role === 'Admin')
                        <li><a href="{{ route('users.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                    height="30" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
                                    <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                    <path
                                        d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1H1Zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1V2Z" />
                                </svg> &nbsp;&nbsp;&nbsp;&nbsp;Users</a></li>
                        <li><a href="{{ route('careers.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                    height="30" fill="currentColor" class="bi bi-wrench-adjustable-circle-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M6.705 8.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z" />
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16Zm-6.202-4.751 1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2a7.031 7.031 0 0 1-2.949-2.951ZM12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z" />
                                </svg> &nbsp;&nbsp;&nbsp;&nbsp;Careers</a></li>

                        <li><a href="{{ route('applicants.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                    height="30" fill="currentColor" class="bi bi-file-earmark-person"
                                    viewBox="0 0 16 16">
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg> &nbsp;&nbsp;&nbsp;&nbsp;Applicants</a></li>

                        <li><a href="{{ route('organizational_chart.index') }}"> <svg xmlns="http://www.w3.org/2000/svg"
                                    width="30" height="30" fill="currentColor" class="bi bi-diagram-3"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                                </svg>&nbsp;&nbsp;&nbsp;&nbsp;Organizational Chart</a></li>
                        <li><a href="{{ route('logs.index') }}"> <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                    height="30" fill="currentColor" class="bi bi-easel3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.5 12v1.134a1 1 0 1 1-1 0V12h-5A1.5 1.5 0 0 1 1 10.5V3h14v7.5a1.5 1.5 0 0 1-1.5 1.5h-5Zm7-10a.5.5 0 0 0 0-1H.5a.5.5 0 0 0 0 1h15Z" />
                                </svg>&nbsp;&nbsp;&nbsp;&nbsp;Logs</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="sub3">
            @yield('sub-content')
        </div>
    </section>





    {{-- <div class="menu_class">
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
        <a class="menu" href="{{ route('news.index') }}">News</a>
        <a class="menu" href="{{ route('announcements.index') }}">Announcements</a>
        <a class="menu" href="{{ route('events.index') }}">Events</a>




        @if (Auth::user()->role === 'Admin')
            <a class="menu" id="menu1" href="{{ route('users.index') }}">Users</a>
            <a class="menu" href="{{ route('careers.index') }}">Careers</a>
            <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
            <a class="menu" href="{{ route('organizational_chart.index') }}">Organizational Chart</a>
            <a class="menu" href="{{ route('logs.index') }}">Logs</a>
        @endif
        @if (Auth::user()->role === 'Principal')
            <a class="menu" href="{{ route('careers.index') }}">Careers</a>
            <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
            <a class="menu" href="{{ route('organizational_chart.index') }}">Organizational Chart</a>
            <a class="menu" href="#feedback">Feedback</a>
        @endif
        @if (Auth::user()->role === 'Registrar')
            <a class="menu" href="{{ route('requests.index') }}">Requested School Form</a>
            <a class="menu" href="{{ route('careers.index') }}">Careers</a>
            <a class="menu" href="{{ route('applicants.index') }}">Applicant</a>
            <a class="menu" href="{{ route('organizational_chart.index') }}">Organizational Chart</a>
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

</div> --}}
@endsection
