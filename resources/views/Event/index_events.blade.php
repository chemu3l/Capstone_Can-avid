@extends('dashboard.dashboard')

@section('sub-content')
<a href="{{ route('events.create') }}" class="btn btn-info btn-lg">Add Events</a>
    <h1>Events Table </h1>
    <table class="table table-x1 table-striped table-dark ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Events Title</th>
                <th scope="col">Events Description</th>
                <th scope="col">Events Uploaded</th>
                <th scope="col">Events Started</th>
                <th scope="col">Events End</th>
                <th scope="col">Events Images</th>
                <th scope="col">Personnel Added</th>
                <th scope="col">EDIT</th>
                <th scope="col">VIEW</th>
                <th scope="col">DELETE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->events }}</td>
                    <td>{{ $event->events_description }}</td>
                    <td>{{ date('m-d-Y', strtotime($event->events_uploaded)) }}</td>
                    <td>{{ date('m-d-Y', strtotime($event->events_started)) }}</td>
                    <td>{{ date('m-d-Y', strtotime($event->events_end)) }}</td>
                    <td>
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

                    </td>
                    <td>{{ $event->profile->name }}</td>
                    <td>
                        <a href="{{ route('events.edit', $event) }}"
                            class="btn btn-primary">EDIT</a>
                    </td>
                    <td>
                        <a href="{{ route('events.show', $event) }}"
                            class="btn btn-primary">VIEW</a>
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
@endsection
