@extends('dashboard.dashboard')

@section('sub-content')
<a href="{{ route('alumnis.index') }}" class="btn btn-info btn-lg">Go Back</a>
    <form action="{{ route('alumnis.update', $alumni) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" class="form-control @error('student_name') is-invalid @enderror" name="student_name" value="{{ $alumni->student_name}}">
        </div>
        <div class="form-group">
            <label for="section">Section:</label>
            <input type="text" class="form-control @error('section') is-invalid @enderror" name="section" value="{{ $alumni->section}}" >
        </div>
        <div class="form-group">
            <label for="alumni_specialization">Specialization:</label>
            <input type="text" class="form-control @error('alumni_specialization') is-invalid @enderror" name="alumni_specialization"  value="{{ $alumni->alumni_specialization}}">
        </div>
        <div class="form-group">
            <label for="class_year">Class Year:</label>
            <input type="text" class="form-control @error('class_year') is-invalid @enderror" name="class_year" value="{{ $alumni->class_year}}">
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">Add Alumni</button>
        </div>
    </form>
@endsection
