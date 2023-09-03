@extends('dashboard.dashboard')

@section('sub-content')
<a href="{{ route('announcements.index') }}" class="btn btn-info btn-lg">Go Back</a><br>
    <div class="row">
        <div class="col-sm-8">
            <h4>{{ $announcement->id }}</h4>
            <h1>{{ $announcement->announcements }}</h1>
            <p> {{ $announcement->announcements_what }}</p>
            <p> {{ $announcement->announcements_who  }}</p>
            <p> {{ $announcement->announcements_when }}</p>
            <p> {{ $announcement->announcements_where }}</p>
            <p> {{ $announcement->announcements_why }}</p>
            <p> {{ $announcement->announcements_how }}</p>
            <p> {{ $announcement->profile->name }}</p>
            <p> {{ $announcement->announcements_uploaded }}</p>
        </div>
        <div class="col-sm-4">
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
        </div>
      </div>
@endsection
