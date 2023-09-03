@extends('dashboard.dashboard')

@section('sub-content')
    <a href="{{ route('careers.index') }}" class="btn btn-info btn-lg">Go Back</a>
    <form action="{{ route('careers.update', $career) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="career_position">Career Position:</label>
            <input type="text" class="form-control @error('career_position') is-invalid @enderror" name="career_position" value="{{ $career->career_position }}">
        </div>
        <center>
            <h6>--------------------------------------------------------------------------------------------</h6>
        </center>
        <div class="form-group">
            <label for="career_description">Career Description:</label>
            <input type="text" class="form-control @error('career_description') is-invalid @enderror" name="career_description" value="{{ $career->career_description}}">
        </div>
        <div class="form-group">
            <label for="career_requirements">Career Requirements:</label>
            <input type="text" class="form-control @error('career_requirements') is-invalid @enderror"
                name="career_requirements" value="{{ $career->career_requirements }}">
        </div>
        <br>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">Update Career</button>
        </div>
    </form>
@endsection
