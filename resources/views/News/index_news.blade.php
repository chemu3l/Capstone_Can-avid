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
            <a href="{{ route('news.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%">Add
                News</a>
            <h1>News Table </h1>
            <form action="{{ route('news_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col">News Title</th>
                    <th scope="col">News Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">News Updated</th>
                    <th scope="col">News Uploaded</th>
                    <th scope="col">
                        <center>News Images</center>
                    </th>
                    <th scope="col">Personnel Added</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <td>{{ $new->news }}</td>
                        <td>{{ $new->news_description }}</td>
                        @if ($new->status == 'Posted')
                            <td>
                                <div style="background-color: #7A9D54">
                                    <center>{{ $new->status }}</center>
                                </div>
                            </td>
                        @elseif ($new->status == 'Registrar Verified')
                            <td>
                                <div style="background-color: #EEE2DE">
                                    <center>{{ $new->status }}</center>
                                </div>
                            </td>
                        @else
                            <td>
                                <div style="background-color: #4F709C">
                                    <center>{{ $new->status }}</center>
                                </div>
                            </td>
                        @endif
                        <td>{{ date('m-d-Y', strtotime($new->news_updated)) }}</td>
                        <td>{{ date('m-d-Y', strtotime($new->news_uploaded)) }}</td>
                        <td>
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
                        <td>{{ $new->profile->name }}</td>
                        <td>
                            <a href="{{ route('news.edit', $new) }}"
                                class="btn btn-primary"style="background-color: green">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('news.show', $new) }}"
                                class="btn btn-primary"style="background-color: green">VIEW</a>
                        </td>
                        <td>
                            <form action="{{ route('news.destroy', $new) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this News?')">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
