@extends('dashboard.dashboard')

@section('sub-content')
    <h1>{{ $applicant->applicant_name}}</h1>
    <h2>{{ $applicant->career->career_position }}
    <h6>{{ $applicant->date_applied}}
    <h3>{{ $applicant->applicant_email }}
    <iframe height="700px" width="110%" src="{{ asset('storage/' . $path) }}"></iframe>
@endsection
