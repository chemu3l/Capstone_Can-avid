@extends('dashboard.dashboard')

@section('sub-content')
    <a href="{{ route('careers.index') }}" class="btn btn-info btn-lg">Go Back</a>
    <form action="{{ route('careers.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="career_position">Career Position:</label>
            <input type="text" class="form-control @error('career_position') is-invalid @enderror" name="career_position" required>
        </div>
        <center>
            <h6>--------------------------------------------------------------------------------------------</h6>
        </center>
        <div class="form-group">
            <label for="career_description">Career Description:</label>
            <input type="text" class="form-control @error('career_description') is-invalid @enderror" name="career_description" required>
        </div>
        <div class="form-group">
            <label for="career_requirements">Career Requirements:</label>
            <input type="text" class="form-control @error('career_requirements') is-invalid @enderror"
                name="career_requirements" required>
        </div>
        <br>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">Add Career</button>
        </div>
    </form>
@endsection
