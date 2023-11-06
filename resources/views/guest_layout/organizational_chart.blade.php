@extends('welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/organizational_chart.css') }}">
    <center>
        <div class="card">
            @if ($path == 'images/CNHS_IMAGE/chart_org.jpg')
                <img src="{{ asset('images/CNHS_IMAGE/chart_org.jpg') }}" alt="Organizational Chart">
            @else
                <img src="{{ asset('storage/' . $path) }}" alt="Image">
            @endif
        </div>
    </center>
@endsection
