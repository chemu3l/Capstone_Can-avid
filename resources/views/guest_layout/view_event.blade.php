@extends('welcome')

@section('content')
    <div class="headers_text_title">
        Event
        <h1>{{ $event->events }}</h1>
    </div>
    <div class="menu-event">
        <div class="sub-menu-event">
            <h4 id="descriptions-event">{{ $event->events_description }}</h4>
            <p> Started: {{ $event->events_started }}</p>
            <p> Ended: {{ $event->events_end }}</p>
        </div>
    </div>
    <div id="slideshow">
        <p class="slideshow-title">Images and Video</p>
        <div class="entire-content">
            <div class="content-carousel">
                @if ($event->events_images)
                    @foreach (json_decode($event->events_images) as $mediaUrl)
                        <figure class="shadow">
                            @if (Str::contains($mediaUrl, ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ asset('storage/' . $mediaUrl) }}" alt="Image">
                            @else
                                <video controls>
                                    <source src="{{ asset('storage/' . $mediaUrl) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </figure>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
