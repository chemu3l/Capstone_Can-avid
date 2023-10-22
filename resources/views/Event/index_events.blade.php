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
        <div class="header-tables-page">
            <a href="{{ route('events.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%">Add Events</a>
            <h1>Events Table </h1>
            <form action="{{ route('event_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table
            style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; padding-right:40%; ">
            <thead>
                <tr>
                    <th scope="col">Events Title</th>
                    <th scope="col">Events Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Events Uploaded</th>
                    <th scope="col">Events Started</th>
                    <th scope="col">Events End</th>
                    <th scope="col">
                        <center>Events Images</center>
                    </th>
                    <th scope="col">Personnel Added</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->events }}</td>
                        <td>{{ $event->events_description }}</td>
                        @if ($event->status == 'Posted')
                            <td>
                                <div style="background-color: #7A9D54">
                                    <center>{{ $event->status }}</center>
                                </div>
                            </td>
                        @elseif ($event->status == 'Registrar Verified')
                            <td>
                                <div style="background-color: #EEE2DE">
                                    <center>{{ $event->status }}</center>
                                </div>
                            </td>
                        @else
                            <td>
                                <div style="background-color: #4F709C">
                                    <center>{{ $event->status }}</center>
                                </div>
                            </td>
                        @endif
                        <td>{{ date('m-d-Y', strtotime($event->events_uploaded)) }}</td>
                        <td>{{ date('m-d-Y', strtotime($event->events_started)) }}</td>
                        <td>{{ date('m-d-Y', strtotime($event->events_end)) }}</td>
                        <td>
                            <center>
                                @if ($event->events_images)
                                    @foreach (json_decode($event->events_images) as $mediaUrl)
                                        @if (Str::contains($mediaUrl, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <img src="{{ asset('storage/' . $mediaUrl) }}" alt="Image"
                                                style="height:100px; width:100px; border-radius:50%;">
                                        @else
                                            <div class="video-styles-in-administer">
                                                <video controls>
                                                    <source src="{{ asset('storage/' . $mediaUrl) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </center>
                        </td>
                        <td>{{ $event->profile->name }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-primary"
                                style="background-color: green">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-primary"
                                style="background-color: green">VIEW</a>
                        </td>
                        <td>
                            <form action="{{ route('events.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this announcement?')">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
