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
        <a href="{{ route('announcements.index') }}" class="btn btn-info btn-lg"
            style="background-color: green; margin-bottom:3%">Go Back</a>
        <form action="{{ route('announcements.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="announcements">Announcement Title:</label>
                <input type="text" class="form-control @error('announcements') is-invalid @enderror" name="announcements"
                    id="announcements" required>
                <span class="text-danger">
                    @error('announcements')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <center>
                <h6>Follow Up Question</h6>
            </center>
            <div class="form-group">
                <label for="announcements_what">What:</label>
                <input type="text" class="form-control @error('announcements_what') is-invalid @enderror"
                    name="announcements_what" id="announcements_what"required>
                <span class="text-danger">
                    @error('announcements_what')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="announcements_who">Who:</label>
                <input type="text" class="form-control @error('announcements_who') is-invalid @enderror"
                    name="announcements_who" id="announcements_who"required>
                <span class="text-danger">
                    @error('announcements_who')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="announcements_when">When:</label>
                <input type="date" class="form-control @error('announcements_when') is-invalid @enderror"
                    name="announcements_when" id="announcements_when"required>
                <span class="text-danger">
                    @error('announcements_when')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="announcements_where">Where:</label>
                <input type="text" class="form-control @error('announcements_where') is-invalid @enderror"
                    name="announcements_where" id="announcements_where"required>
                <span class="text-danger">
                    @error('announcements_where')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="announcements_why">Why:</label>
                <input type="text" class="form-control @error('announcements_why') is-invalid @enderror"
                    name="announcements_why" id="announcements_why"required>
                <span class="text-danger">
                    @error('announcements_why')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="announcements_how">How:</label>
                <input type="text" class="form-control @error('announcements_how') is-invalid @enderror"
                    name="announcements_how" id="announcements_how"required>
                <span class="text-danger">
                    @error('announcements_how')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control @error('profile_id') is-invalid @enderror" name="profile_id"
                    id="profile_id" value="{{ Auth::guard('web')->user()->profile->id }}" required>
                <span class="text-danger">
                    @error('profile_id')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <input type="file" name="media_files" accept="image/*, video/*" required>
            <span class="text-danger">
                @error('media_files')
                    {{ $message }}
                @enderror
            </span>
            <br>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block" style="background-color: green; margin-top:2%">Add
                    Announcement</button>
            </div>
        </form>
    </div>
@endsection
