@extends('dashboard.dashboard')

@section('sub-content')
    <a href="{{ route('alumnis.index') }}" class="btn btn-info btn-lg">Go Back</a><br>
    <div class="row">
        <div class="col-sm-8">
            <h4>{{ $alumni->id }}</h4>
            <p> {{ $alumni->student_name }}</p>
            <p> {{ $alumni->section }}</p>
            <p> {{ $alumni->alumni_specialization }}</p>
            <p> {{ $alumni->class_year }}</p>
            <p> {{ $alumni->profile->name }}</p>
            <p> {{ $alumni->uploaded_at }}</p>
        </div>
        <div class="col-sm-4">
            <h1>HUHU</h1>
        </div>
    </div>
@endsection
