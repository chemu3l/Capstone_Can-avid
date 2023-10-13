@extends('dashboard.sidebar')

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
        <form action="{{ route('careers.update', $career) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="career_position">Career Position:</label>
                <input type="text" class="form-control @error('career_position') is-invalid @enderror"
                    name="career_position" value="{{ $career->career_position }}">
            </div>
            <center>
                <h6>--------------------------------------------------------------------------------------------</h6>
            </center>
            <div class="form-group">
                <label for="career_description">Career Description:</label>
                <input type="text" class="form-control @error('career_description') is-invalid @enderror"
                    name="career_description" value="{{ $career->career_description }}">
            </div>
            <div class="form-group">
                <label for="career_requirements">Career Requirements:</label>
                <input type="text" class="form-control @error('career_requirements') is-invalid @enderror"
                    name="career_requirements" value="{{ $career->career_requirements }}">
            </div>
            <div class="form-group ">
                <label for="status">Status:</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Principal')
                        <option value="Posted" {{ old('status', $career->status) === 'Posted' ? 'selected' : '' }}>
                            Posted
                        </option>
                    @elseif (Auth::user()->role == 'Registrar')
                        <option value="Registrar Verified"
                            {{ old('status', $career->status) === 'Registrar Verified' ? 'selected' : '' }}>
                            Registrar Verified
                        </option>
                    @endif
                    @if (Auth::user()->role == 'Admin' ||
                            Auth::user()->role == 'Principal' ||
                            Auth::user()->role == 'Registrar' ||
                            Auth::user()->role == 'Faculty')
                        <option value="Pending" {{ old('status', $career->status) === 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                    @endif
                </select>

                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block" style="background-color: green;">Update
                    Career</button>
            </div>
        </form>
    </div>
@endsection
