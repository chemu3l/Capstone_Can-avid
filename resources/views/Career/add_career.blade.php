@extends('home')

@section('sub-content')
    <div class="tables-administer">
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
        <a href="{{ route('careers.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom:3%">Go
            Back</a>
        <form action="{{ route('careers.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="career_position">Position:</label>
                <input type="text" class="form-control @error('career_position') is-invalid @enderror"
                    name="career_position" required>
            </div>
            <center>
                <h6>--------------------------------------------------------------------------------------------</h6>
            </center>
            <div class="form-group">
                <label for="career_description">Description:</label>
                <input type="text" class="form-control @error('career_description') is-invalid @enderror"
                    name="career_description" required>
            </div>
            <div class="form-group">
                <label for="career_requirements">Requirements:</label>
                <input type="text" class="form-control @error('career_requirements') is-invalid @enderror"
                    name="career_requirements" required>
            </div>
            <br>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block" style="background-color: green">Add Career</button>
            </div>
        </form>
    </div>
@endsection
