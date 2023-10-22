@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <div class="header-tables-page">
            <a href="{{ route('announcements.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%">Add Announcement</a>
            <h1>Announcement Table </h1>
            <form action="{{ route('announcement_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; padding-right:40%; ">
            <thead>
                <tr>
                    <th colspan="7"
                        style="border-color: #EEE2DE; border-size: 200px; text-align: center; border: 2px solid green; font-weight: bold; text-transform:uppercase">
                        Announcement</th>
                </tr>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">What</th>
                    <th scope="col">Who</th>
                    <th scope="col">When</th>
                    <th scope="col">Where</th>
                    <th scope="col">Why</th>
                    <th scope="col">How</th>
                    <th scope="col">Status</th>
                    <th scope="col">Personnel Added</th>
                    <th scope="col">
                        <center>Announcement Images</center>
                    </th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @if (count($announcements) > 0)
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->announcements }}</td>
                            <td>{{ $announcement->announcements_what }}</td>
                            <td>{{ $announcement->announcements_who }}</td>
                            <td>{{ date('m-d-Y', strtotime($announcement->announcements_when)) }}</td>
                            <td>{{ $announcement->announcements_where }}</td>
                            <td>{{ $announcement->announcements_why }}</td>
                            <td>{{ $announcement->announcements_how }}</td>
                            @if ($announcement->status == 'Posted')
                                <td>
                                    <div style="background-color: #7A9D54">
                                        <center>{{ $announcement->status }}</center>
                                    </div>
                                </td>
                            @elseif ($announcement->status == 'Registrar Verified')
                                <td>
                                    <div style="background-color: #EEE2DE">
                                        <center>{{ $announcement->status }}</center>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div style="background-color: #4F709C">
                                        <center>{{ $announcement->status }}</center>
                                    </div>
                                </td>
                            @endif
                            <td>{{ $announcement->profile->name }}</td>
                            <td>
                                <center>
                                    @if ($announcement->announcements_images)
                                        @foreach (json_decode($announcement->announcements_images) as $mediaUrl)
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
                            <td>
                                <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-primary"
                                    style="background-color: green">EDIT</a>
                            </td>
                            <td>
                                <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary"
                                    style="background-color: green">VIEW</a>
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
                @else
                    <tr>
                        <td colspan="13">No matching announcements found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
