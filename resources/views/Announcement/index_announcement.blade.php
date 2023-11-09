@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <div class="header-tables-page" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('announcements.create') }}" class="btn btn-info btn-lg" style="background-color: green;">Add Announcement</a>
            <h1>Announcement Table </h1>
            <form action="{{ route('announcement_Filter') }}" method="GET" id="searchForm" style="display: flex; align-items: center;">
                <input type="text" name="search" placeholder="Search..." style="margin-right: 10px;">
                <button type="submit">Search</button>
            </form>
        </div>

        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; padding-right:40%;  ">
            <thead>
                <tr>
                    <th colspan="7"
                        style="border-color: #EEE2DE; border-size: 200px; text-align: center; border: 2px solid green; font-weight: bold; text-transform:uppercase; max-height: 100px;">
                        Announcement</th>
                </tr>
                <tr>
                    <th scope="col"><center>Title<center></th>
                    <th scope="col"><center>What<center></th>
                    <th scope="col"><center>Who<center></th>
                    <th scope="col"><center>When<center></th>
                    <th scope="col"><center>Where<center></th>
                    <th scope="col"><center>Why<center></th>
                    <th scope="col"><center>How<center></th>
                    <th scope="col"><center>Status<center></th>
                    <th scope="col"><center>Uploaded<center></th>
                    <th scope="col"><center>Personnel Added<center></th>
                    <th scope="col"><center>Announcement Images</center></th>
                    <th scope="col"><center>EDIT<center></th>
                    <th scope="col"><center>VIEW<center></th>
                    <th scope="col"><center>DELETE<center></th>
                </tr>
            </thead>
            <tbody>
                @if (count($announcements) > 0)
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements_what }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements_who }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ date('m-d-Y', strtotime($announcement->announcements_when)) }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements_where }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements_why }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements_how }}</td>
                            @if ($announcement->status == 'Posted')
                                <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                    <div style="background-color: #7A9D54 white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                        <center>{{ $announcement->status }}</center>
                                    </div>
                                </td>
                            @elseif ($announcement->status == 'Registrar Verified')
                                <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                    <div style="background-color: #EEE2DE">
                                        <center>{{ $announcement->status }}</center>
                                    </div>
                                </td>
                            @else
                                <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                    <div style="background-color: #4F709C">
                                        <center>{{ $announcement->status }}</center>
                                    </div>
                                </td>
                            @endif
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->announcements_uploaded }}</td>

                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">{{ $announcement->profile->name }}</td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                <center>
                                    @if ($announcement->announcements_images)
                                        @foreach (json_decode($announcement->announcements_images) as $mediaUrl)
                                            @if (Str::contains($mediaUrl, ['.jpg', '.jpeg', '.png', '.gif']))
                                                <img src="{{ asset('storage/' . $mediaUrl) }}" alt="Image"
                                                    style="height:100px; width:100px; border-radius:50%;">
                                            @else
                                                <div class="video-styles-in-administer">
                                                    <video controls style="width: 200px;">
                                                        <source src="{{ asset('storage/' . $mediaUrl) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </center>
                            </td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-primary"
                                    style="background-color: green">EDIT</a>
                            </td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
                                <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-primary"
                                    style="background-color: green">VIEW</a>
                            </td>
                            <td style="border: 1px solid #7A9D54; white-space: normal; width: 10px; word-wrap: break-word; overflow-wrap: break-word;">
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
