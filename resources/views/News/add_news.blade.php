@extends('dashboard.dashboard')

@section('sub-content')
    <a href="{{ route('news.index') }}" class="btn btn-info btn-lg">Go Back</a>
    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label for="news">News Title:</label>
            <input type="text" class="form-control @error('news') is-invalid @enderror" name="news" id="news"
                required>
        </div>

        <div class="form-group">
            <label for="news_description">News Description:</label>
            <input type="text" class="form-control @error('news_description') is-invalid @enderror"
                name="news_description" id="news_description"required>
        </div>

        <div class="form-group">
            <label for="news_update">News Update:</label>
            <input type="date" class="form-control @error('news_update') is-invalid @enderror" name="news_update"
                id="news_update"required>
        </div>

        <input type="file" name="media_files[]" accept="image/*, video/*" multiple required>
        <span class="text-danger">
            @error('media_files')
                {{ $message }}
            @enderror
        </span>
        <div class="form-group">
            <input type="hidden" class="form-control @error('personnel_added') is-invalid @enderror" name="personnel_added"
                id="personnel_added" value="{{ Auth::guard('web')->user()->profile->id }}" required>
            <span class="text-danger">
                @error('personnel_added')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block">Add News</button>
        </div>
    </form>
@endsection
