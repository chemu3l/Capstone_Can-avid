@extends('dashboard.dashboard')

@section('sub-content')
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
<a href="{{ route('news.create') }}" class="btn btn-info btn-lg">Add  News</a>
    <h1>News Table </h1>
    <table class="table table-x1 table-striped table-dark ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">News Title</th>
                <th scope="col">News Description</th>
                <th scope="col">News Updated</th>
                <th scope="col">News Uploaded</th>
                <th scope="col">News Images</th>
                <th scope="col">Personnel Added</th>
                <th scope="col">EDIT</th>
                <th scope="col">VIEW</th>
                <th scope="col">DELETE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $new)
                <tr>
                    <td>{{ $new->id }}</td>
                    <td>{{ $new->news }}</td>
                    <td>{{ $new->news_description }}</td>
                    <td>{{ date('m-d-Y', strtotime($new->news_updated)) }}</td>
                    <td>{{ date('m-d-Y', strtotime($new->news_uploaded)) }}</td>
                    <td>
                        @if ($new->news_images)
                            @foreach (json_decode($new->news_images) as $mediaUrl)
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
                    <td>{{ $new->profile->name }}</td>
                    <td>
                        <a href="{{ route('news.edit', $new) }}" class="btn btn-primary">EDIT</a>
                    </td>
                    <td>
                        <a href="{{ route('news.show', $new) }}" class="btn btn-primary">VIEW</a>
                    </td>
                    <td>
                        <form action="{{ route('news.destroy', $new) }}" method="POST">
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
