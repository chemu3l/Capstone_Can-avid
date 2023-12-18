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
        <a href="{{ route('events.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom:3%">Go
            Back</a>
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::get('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @csrf
            <div class="form-group">
                <label for="events">Events Title:</label>
                <input type="text" class="form-control @error('events') is-invalid @enderror" name="events"
                    id="events" value="{{ old('events') }}" required>
                <span class="text-danger">
                    @error('events')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">

                <label for="events_description">Description:</label>
                <input type="text"
                    class="form-control @error('events_description') is-invalid @enderror"name="events_description"
                    id="events_description" value="{{ old('events_description') }}"
                    placeholder="Make the people understand clearer by addressing 5W and 1H">
                <span class="text-danger">
                    @error('events_description')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="events_started">Started:</label>
                <input type="date"
                    class="form-control @error('events_started') is-invalid @enderror"name="events_started"
                    id="events_started" value="{{ old('events_started') }}"required>
                <span class="text-danger">
                    @error('events_started')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            {{-- <div class="form-group">
                <label for="events_end">Events End:</label>
                <input type="date" class="form-control @error('events_end') is-invalid @enderror"name="events_end"
                    id="events_end" value="{{ old('events_end') }}"required>
                <span class="text-danger">
                    @error('events_end')
                        {{ $message }}
                    @enderror
                </span>
            </div> --}}
            <input type="file" name="media_files[]" accept="image/*, video/*" multiple required>
            <span class="text-danger">
                @error('media_files')
                    {{ $message }}
                @enderror
            </span>
            <div class="form-group">
                <input type="hidden" class="form-control @error('personnel_added') is-invalid @enderror"
                    name="personnel_added" id="personnel_added" value="{{ Auth::guard('web')->user()->profile->id }}"
                    required>
                <span class="text-danger">
                    @error('personnel_added')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group text-center"><button type="submit" class="btn btn-primary btn-block"
                    style="background-color: green">Submit</button></div>
        </form>
    </div>
@endsection
