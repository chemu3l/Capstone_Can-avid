@extends('dashboard.dashboard')

@section('sub-content')
    <a href="{{ route('events.index') }}" class="btn btn-info btn-lg">Go Back</a>
    <div class="row">
        <div class="col-sm-8">
            <h4>{{ $event->id }}</h4>
            <h1>{{ $event->events }}</h1>
            <p> {{ $event->events_description }}</p>
            <p> {{ $event->events_started }}</p>
            <p> {{ $event->events_end }}</p>
            <p> {{ $event->events_uploaded }}</p>
            <p> {{ $event->profile->name }}</p>
        </div>
        <div class="col-sm-4">
            @if ($event->events_images)
                @foreach (json_decode($event->events_images) as $mediaUrl)
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
        </div>
    </div>
@endsection
