@extends('dashboard.user.admin.admin_dashboard')

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
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#CreateUser"
            id="create_user">Create Events</button>
        <!-- #Create Events -->
        <div class="modal fade" id="CreateUser" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create Events</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.create_event') }}" method="POST" enctype="multipart/form-data">
                            @if (Session::get('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::get('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="events">Events Title:</label>
                                <input type="text" class="form-control @error('events') is-invalid @enderror"
                                    name="events" id="events" value="{{ old('events') }}" required>
                                <span class="text-danger">
                                    @error('events')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">

                                <label for="events_description">Events Description:</label>
                                <input type="text"
                                    class="form-control @error('events_description') is-invalid @enderror"name="events_description"
                                    id="events_description" value="{{ old('events_description') }}" placeholder="Make the people understand clearer by addressing 5W and 1H">
                                <span class="text-danger">
                                    @error('events_description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="events_scheduled">Events Scheduled:</label>
                                <input type="date"
                                    class="form-control @error('events_scheduled') is-invalid @enderror"name="events_scheduled"
                                    id="events_scheduled" value="{{ old('events_scheduled') }}"required>
                                <span class="text-danger">
                                    @error('events_scheduled')
                                        {{ $message }}
                                    @enderror
                                </span>
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
                            <div class="form-group text-center"><button type="submit"
                                    class="btn btn-primary btn-block">Submit</button></div>
                        </form>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
        <!-- #End Create User -->
        <h1>Events Table </h1>
        <table class="table table-x1 table-striped table-dark ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Events Title</th>
                    <th scope="col">Events Description</th>
                    <th scope="col">Events Uploaded</th>
                    <th scope="col">Events Scheduled</th>
                    <th scope="col">Events Images</th>
                    <th scope="col">Personnel Added</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->events }}</td>
                        <td>{{ $event->events_description }}</td>
                        <td>{{ date('m-d-Y', strtotime($event->events_uploaded)) }}</td>
                        <td>{{ date('m-d-Y', strtotime($event->events_scheduled)) }}</td>
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
                            <button onclick="document.getElementById('id01').style.display='block'"
                                class="w3-button w3-light-green action-user-btn" data-toggle="actions" data-target="#id01"
                                data-user="{{ json_encode($event) }}">Actions</button>
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
                        <button class="w3-bar-item w3-button edit-user-btn" onclick="openAction('EDITEvent')">Edit
                            Event</button>
                        <button class="w3-bar-item w3-button " onclick="openAction('VIEWEvent')">VIEW Event</button>
                        <button class="w3-bar-item w3-button" onclick="openAction('DELETEEvent')">Delete Event</button>
                    </div>
                </header>
                <div id="EDITEvent" class="w3-container actions" style="display:none"
                    data-asset-url="{{ asset('storage/') }}">
                    <form action="{{ route('user.update_event') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                        <input type="hidden" class="form-control @error('id') is-invalid @enderror" name="id"
                            id="edit-event-id" value="{{ old('id') }}" required>
                        <div class="form-group">
                            <label for="events">Event Title</label>
                            <input type="text" class="form-control @error('events') is-invalid @enderror"
                                name="events" id="edit-events" value="{{ old('events') }}">
                            <span class="text-danger">
                                @error('events')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="events_description">Events Description:</label>
                            <input type="text" class="form-control @error('events_description') is-invalid @enderror"
                                name="events_description" id="edit-events-description"
                                value="{{ old('events_description') }}" >
                            <span class="text-danger">
                                @error('events_description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="events_scheduled">Events Schedule:</label>
                            <input type="date" class="form-control @error('events_scheduled') is-invalid @enderror"
                                name="events_scheduled" id="edit-events-scheduled"
                                value="{{ old('events_scheduled') }}">
                            <span class="text-danger">
                                @error('events_scheduled')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <input type="hidden" id="editEventImagesElement" name="events_images">
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

                <div id="VIEWEvent" class="w3-container actions" style="display:block"
                    data-asset-url="{{ asset('storage/') }}">
                    <form>
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

                        <div class="form-group">
                            <label for="id">Event ID</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                                id="view-event-id" value="{{ old('id') }}">
                        </div>
                        <div class="form-group">
                            <label for="events">Event Title</label>
                            <input type="text" class="form-control @error('events') is-invalid @enderror"
                                name="events" id="view-events" value="{{ old('events') }}" required>
                            <span class="text-danger">
                                @error('events')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="events_description">Events Description:</label>
                            <input type="text" class="form-control @error('events_description') is-invalid @enderror"
                                name="events_description" id="view-events-description"
                                value="{{ old('events_description') }}" required>
                            <span class="text-danger">
                                @error('events_description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="events_scheduled">Events Schedule:</label>
                            <input type="date" class="form-control @error('events_scheduled') is-invalid @enderror"
                                name="events_scheduled" id="view-events-scheduled" value="{{ old('events_scheduled') }}"
                                required>
                            <span class="text-danger">
                                @error('events_scheduled')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="events_uploaded">Events Uploaded:</label>
                            <input type="date" class="form-control @error('events_uploaded') is-invalid @enderror"
                                name="events_uploaded" id="view-events-uploaded" value="{{ old('events_uploaded') }}"
                                required>
                            <span class="text-danger">
                                @error('events_scheduled')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="events_personnel">Events Uploader:</label>
                            <input type="text" class="form-control @error('events_personnel') is-invalid @enderror"
                                name="events_personnel" id="view-events-personnel" value="{{ old('events_personnel') }}"
                                readonly>
                            <span class="text-danger">
                                @error('events_personnel')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <input type="hidden" id="viewEventImagesElement" name="events_images">
                        <div id="imageContainer"></div>


                        <br>
                    </form>
                </div>

                <div id="DELETEEvent" class="w3-container actions" style="display:none">
                    <h2>Delete Event</h2>

                    <form action="{{ route('user.delete_event') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                            id="delete-event-id" value="{{ old('id') }}" required readonly>
                        <button type="submit" class="delete-user-btn"
                            style="background-color: #DC0000; width:100px; height: 35px; border-radius: 5px;">DELETE</button>
                    </form>


                    <br><br>
                </div>
            </div>


        </div>
    </div>

    <script src="{{ asset('js/Event/menu_event.js') }}"></script>
    <script src="{{ asset('js/Event/edit_event.js') }}"></script>
    <script src="{{ asset('js/Event/view_event.js') }}"></script>
    <script src="{{ asset('js/Event/delete_event.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
