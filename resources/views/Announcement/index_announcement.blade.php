@extends('dashboard.dashboard')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">

    <div class="container scrollable-div">
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
        <a href="{{ route('announcements.create') }}" class="btn btn-info btn-lg">Add  Announcement</a>

        <h1>Announcement Table </h1>
        <table class="table table-x1 table-striped table-dark ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Announcement Title</th>
                    <th scope="col">Announcement What</th>
                    <th scope="col">Announcement Who</th>
                    <th scope="col">Announcement When</th>
                    <th scope="col">Announcement Where</th>
                    <th scope="col">Announcement Why</th>
                    <th scope="col">Announcement How</th>
                    <th scope="col">Personnel Added</th>
                    <th scope="col">Announcement Images</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr id="announcementRow{{ $announcement->id }}">
                        <td>{{ $announcement->id }}</td>
                        <td>{{ $announcement->announcements }}</td>
                        <td>{{ $announcement->announcements_what }}</td>
                        <td>{{ $announcement->announcements_who }}</td>
                        <td>{{ date('m-d-Y', strtotime($announcement->announcements_when)) }}</td>
                        <td>{{ $announcement->announcements_where }}</td>
                        <td>{{ $announcement->announcements_why }}</td>
                        <td>{{ $announcement->announcements_how }}</td>
                        <td>{{ $announcement->profile->name }}</td>
                        <td>
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
                        </td>
                        <td>
                            <a href="{{ route('announcements.edit', $announcement) }}"
                                class="btn btn-primary">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('announcements.show', $announcement) }}"
                                class="btn btn-primary">VIEW</a>
                        </td>
                        <td>
                            <form action="{{ route('announcements.destroy', $announcement) }}" method="POST">
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
    <script src="{{ asset('js/home_function/menu.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
