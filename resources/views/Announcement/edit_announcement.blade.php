@extends('dashboard.sidebar')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('announcements.index') }}" class="btn btn-info btn-lg"
            style="background-color: green; margin-bottom:3%">Go Back</a>
        <form method="POST" enctype="multipart/form-data" action="{{ route('announcements.update', $announcement) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="announcements">Announcement Title:</label>
                <input type="text" class="form-control @error('announcements') is-invalid @enderror" name="announcements"
                    value="{{ $announcement->announcements }}">
            </div>
            <center>
                <h6>Follow Up Question</h6>
            </center>
            <div class="form-group">
                <label for="announcements_what">What:</label>
                <input type="text" class="form-control" name="announcements_what"
                    value="{{ $announcement->announcements_what }}">
            </div>
            <div class="form-group">
                <label for="announcements_who">Who:</label>
                <input type="text" class="form-control" name="announcements_who"
                    value="{{ $announcement->announcements_who }}">
            </div>

            <div class="form-group">
                <label for="announcements_when">When:</label>
                <input type="date" class="form-control" name="announcements_when"
                    value="{{ $announcement->announcements_when }}">
            </div>

            <div class="form-group">
                <label for="announcements_where">Where:</label>
                <input type="text" class="form-control" name="announcements_where"
                    value="{{ $announcement->announcements_where }}">
            </div>
            <div class="form-group">
                <label for="announcements_why">Why:</label>
                <input type="text" class="form-control" name="announcements_why"
                    value="{{ $announcement->announcements_why }}">
            </div>
            <div class="form-group">
                <label for="announcements_how">How:</label>
                <input type="text" class="form-control" name="announcements_how"
                    value="{{ $announcement->announcements_how }}">
            </div>
            <div class="form-group ">
                <label for="status">Status:</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="Posted" {{ old('status', $announcement->status) === 'Posted' ? 'selected' : '' }}>
                        Posted
                    </option>
                    <option value="Registrar Verified"
                        {{ old('status', $announcement->status) === 'Registrar Verified' ? 'selected' : '' }}>
                        Registrar Verified
                    </option>
                    <option value="Pending" {{ old('status', $announcement->status) === 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                </select>

                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @if ($announcement->announcements_images)
                @foreach (json_decode($announcement->announcements_images) as $mediaUrl)
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

            <br>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block"
                    style="background-color: green; margin-top:2%">Update Announcement</button>
            </div>
        </form>
    </div>
@endsection
