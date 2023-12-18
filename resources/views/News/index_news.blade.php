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
        <div class="header-tables-page"  style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('news.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%">Add
                News</a>
            <h1>News Table </h1>
            <form action="{{ route('news_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" style="background-color: #56C46F">Search</button>
            </form>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Title</th>
                    <th scope="col" style="padding:10px;">Description</th>
                    <th scope="col" style="padding:10px;">Status</th>
                    <th scope="col" style="padding:10px;">Updated</th>
                    <th scope="col" style="padding:10px;">Uploaded</th>
                    <th scope="col" style="padding:10px;">
                        <center>Images</center>
                    </th>
                    <th scope="col" style="padding:10px;">Personnel Added</th>
                    <th scope="col" style="padding:10px;">Edit</th>
                    <th scope="col" style="padding:10px;">View</th>
                    <th scope="col" style="padding:10px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <td style="padding:10px;">{{ $new->news }}</td>
                        <td style="padding:10px;">{{ $new->news_description }}</td>
                        @if ($new->status == 'Posted')
                            <td style="padding:10px;">
                                <div style="background-color: #7A9D54">
                                    <center>{{ $new->status }}</center>
                                </div>
                            </td>
                        @elseif ($new->status == 'Registrar Verified')
                            <td style="padding:10px;">
                                <div style="background-color: #EEE2DE">
                                    <center>{{ $new->status }}</center>
                                </div>
                            </td>
                        @else
                            <td style="padding:10px;">
                                <div style="background-color: #4F709C">
                                    <center>{{ $new->status }}</center>
                                </div>
                            </td>
                        @endif
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($new->news_updated)) }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($new->news_uploaded)) }}</td>
                        <td style="padding:10px;">
                            <center>
                                @if ($new->news_images)
                                    @foreach (json_decode($new->news_images) as $mediaUrl)
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
                        <td style="padding:10px;">{{ $new->profile->name }}</td>
                        <td style="padding:10px;">
                            <a href="{{ route('news.edit', $new) }}"
                                class="btn btn-primary"style="background-color: green">Edit</a>
                        </td>
                        <td style="padding:10px;">
                            <a href="{{ route('news.show', $new) }}"
                                class="btn btn-primary"style="background-color: green">View</a>
                        </td>
                        <td style="padding:10px;">
                            <form action="{{ route('news.destroy', $new) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this News?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
