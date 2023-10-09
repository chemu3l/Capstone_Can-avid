@extends('dashboard.sidebar')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('news.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom: 3%">Go
            Back</a>
        <form method="POST" enctype="multipart/form-data" action="{{ route('news.update', $news) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="news">News Title</label>
                <input type="text" class="form-control @error('news') is-invalid @enderror" name="news"
                    value="{{ $news->news }}">
            </div>
            <div class="form-group">
                <label for="news_description">News Description:</label>
                <input type="text" class="form-control @error('news_description') is-invalid @enderror"
                    name="news_description" value="{{ $news->news_description }}">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="Posted" {{ old('status', $news->status) === 'Posted' ? 'selected' : '' }}>
                        Posted
                    </option>
                    <option value="Registrar Verified"
                        {{ old('status', $news->status) === 'Registrar Verified' ? 'selected' : '' }}>
                        Registrar Verified
                    </option>
                    <option value="Pending" {{ old('status', $news->status) === 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                </select>

                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="news_scheduled">News Update:</label>
                <input type="date" class="form-control @error('news_scheduled') is-invalid @enderror"
                    name="news_scheduled" value="{{ $news->news_updated }}">
            </div>
            @if ($news->news_images)
                @foreach (json_decode($news->news_images) as $mediaUrl)
                    @if (Str::contains($mediaUrl, ['.jpg', '.jpeg', '.png', '.gif']))
                        <img src="{{ asset('storage/' . $mediaUrl) }}" alt="Image"
                            style="height:100px; width:100px; border-radius:50%;">
                    @else
                        <video controls>
                            <source src="{{ asset('storage/' . $mediaUrl) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                @endforeach
            @endif
            <br>
            <input type="file" name="media_files[]" accept="image/*, video/*" multiple>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block"
                    style="background-color: green; margin-top:2%">Submit</button>
            </div>
        </form>
    </div>
@endsection
