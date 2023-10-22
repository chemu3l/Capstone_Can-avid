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
        <a href="{{ route('organizational_chart.index') }}" class="btn btn-info btn-lg"
            style="background-color: green; margin-bottom:3%">Go Back</a>
        <form action="{{ route('organizational_chart.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="picture">Upload a Picture:</label>
                <input type="file" class="form-control-file @error('picture') is-invalid @enderror" name="picture"
                    id="picture" accept="image/*" required>
                <span class="text-danger">
                    @error('picture')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block" style="background-color: green">Add Member</button>
            </div>
        </form>
    </div>
@endsection
