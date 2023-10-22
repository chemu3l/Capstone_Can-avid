@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <h1>{{ $applicant->applicant_name }}</h1>
        <h2>{{ $applicant->career->career_position }}</h2>
        <h6>{{ $applicant->date_applied }}</h6>
        <h3>{{ $applicant->applicant_email }}</h3>
        <iframe height="700px" width="110%" src="{{ asset('storage/' . $path) }}"></iframe>
    </div>
@endsection
