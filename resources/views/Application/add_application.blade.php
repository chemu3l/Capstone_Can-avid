@extends('welcome')

@section('content')
    <form action="{{ route('applicants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <center><h2>Apply for: {{ $career->career_position }}</h2></center>
        <input type="hidden" name="career_id" value="{{ $career->id }}">
        <div class="form-group">
            <label for="applicant_name">Full Name:</label>
            <input type="text" class="form-control @error('applicant_name') is-invalid @enderror" name="applicant_name" required>
        </div>
        <div class="form-group">
            <label for="applicant_email">Email:</label>
            <input type="text" class="form-control @error('applicant_email') is-invalid @enderror" name="applicant_email" required>
        </div>
        <div class="form-group">
            <label for="applicant_resume">Resume:</label>
            <input type="file" class="form-control @error('applicant_resume') is-invalid @enderror" name="applicant_resume" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">Add Career</button>
        </div>
    </form>
@endsection
