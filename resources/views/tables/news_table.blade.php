@extends('dashboard.dashboard')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">

    <div class="container">
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
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="create_news">Add
            News</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create News</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.news.store') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="news">News Title:</label>
                                <input type="text" class="form-control @error('news') is-invalid @enderror"
                                    name="news" id="news" required>
                            </div>

                            <div class="form-group">
                                <label for="news_description">News Description:</label>
                                <input type="text" class="form-control @error('news_description') is-invalid @enderror"
                                    name="news_description" id="news_description"required>
                            </div>

                            <div class="form-group">
                                <label for="news_update">News Update:</label>
                                <input type="date" class="form-control @error('news_update') is-invalid @enderror"
                                    name="news_update" id="news_update"required>
                            </div>

                            <input type="file" name="media_files[]" accept="image/*, video/*" multiple required>
                            <span class="text-danger">
                                @error('media_files')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="form-group">
                                <input type="hidden" class="form-control @error('personnel_added') is-invalid @enderror"
                                    name="personnel_added" id="personnel_added"
                                    value="{{ Auth::guard('web')->user()->profile->id }}" required>
                                <span class="text-danger">
                                    @error('personnel_added')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block">Add News</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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
                    <th scope="col">Actions</th>
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
                            <button onclick="document.getElementById('id01').style.display='block'"
                                class="w3-button w3-light-green action-user-btn" data-toggle="actions" data-target="#id01"
                                data-user="{{ json_encode($new) }}">Actions</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <header class="w3-bar w3-green">
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>
                    <div>
                        <button class="w3-bar-item w3-button edit-user-btn" onclick="openAction('EDITNews')">Edit
                            News</button>
                        <button class="w3-bar-item w3-button " onclick="openAction('VIEWNews')">VIEW News</button>
                        <button class="w3-bar-item w3-button" onclick="openAction('DELETENews')">Delete News</button>
                    </div>
                </header>
                <div id="EDITNews" class="w3-container actions" style="display:none"
                    data-asset-url="{{ asset('storage/') }}">
                    <form action="{{ route('user.news.update', ['news' => $new->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="form-control @error('id') is-invalid @enderror" name="id"
                            id="edit-news-id" value="{{ old('id') }}" required>
                        <div class="form-group">
                            <label for="news">News Title</label>
                            <input type="text" class="form-control @error('news') is-invalid @enderror" name="news"
                                id="edit-news" value="{{ old('news') }}">
                            <span class="text-danger">
                                @error('news')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="news_description">News Description:</label>
                            <input type="text" class="form-control @error('news_description') is-invalid @enderror"
                                name="news_description" id="edit-news-description"
                                value="{{ old('news_description') }}">
                            <span class="text-danger">
                                @error('news_description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="news_scheduled">News Update:</label>
                            <input type="date" class="form-control @error('news_scheduled') is-invalid @enderror"
                                name="news_scheduled" id="edit-news-update" value="{{ old('news_scheduled') }}">
                            <span class="text-danger">
                                @error('news_scheduled')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <input type="hidden" id="editNewsImagesElement" name="news_images">
                        <div id="imageContainer"></div>

                        <input type="file" name="media_files[]" accept="image/*, video/*" multiple>
                        <span class="text-danger">
                            @error('media_files')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>

                <div id="VIEWNews" class="w3-container actions" style="display:none"
                    data-asset-url="{{ asset('storage/') }}">
                    <form>
                        <div class="form-group">
                            <label for="id">News ID</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                                id="view-news-id" value="{{ old('id') }}">
                        </div>
                        <div class="form-group">
                            <label for="news">Event Title</label>
                            <input type="text" class="form-control @error('news') is-invalid @enderror" name="news"
                                id="view-news" value="{{ old('news') }}" required>
                            <span class="text-danger">
                                @error('news')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="news_description">News Description:</label>
                            <input type="text" class="form-control @error('news_description') is-invalid @enderror"
                                name="news_description" id="view-news-description" value="{{ old('news_description') }}"
                                required>
                            <span class="text-danger">
                                @error('news_description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="news_scheduled">News Schedule:</label>
                            <input type="date" class="form-control @error('news_scheduled') is-invalid @enderror"
                                name="news_scheduled" id="view-news-scheduled" value="{{ old('news_scheduled') }}"
                                required>
                            <span class="text-danger">
                                @error('news_scheduled')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="news_uploaded">News Uploaded:</label>
                            <input type="date" class="form-control @error('news_uploaded') is-invalid @enderror"
                                name="news_uploaded" id="view-news-uploaded" value="{{ old('news_uploaded') }}"
                                required>
                            <span class="text-danger">
                                @error('news_scheduled')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="news_personnel">News Uploader:</label>
                            <input type="text" class="form-control @error('news_personnel') is-invalid @enderror"
                                name="news_personnel" id="view-news-personnel" value="{{ old('news_personnel') }}"
                                readonly>
                            <span class="text-danger">
                                @error('news_personnel')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <input type="hidden" id="viewNewsImagesElement" name="news_images">
                        <div id="imageContainer"></div>


                        <br>
                    </form>
                </div>

                <div id="DELETENews" class="w3-container actions" style="display:none">
                    <h2>Delete News</h2>

                    <form action="{{ route('user.news.destroy', ['news' => $new->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                            id="delete-news-id" value="{{ old('id') }}" required readonly>
                        <button type="submit" class="delete-user-btn"
                            style="background-color: #DC0000; width:100px; height: 35px; border-radius: 5px;">DELETE</button>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/home_function/menu.js') }}"></script>
    <script src="{{ asset('js/News/edit_news.js') }}"></script>
    <script src="{{ asset('js/News/view_news.js') }}"></script>
    <script src="{{ asset('js/News/delete_news.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
