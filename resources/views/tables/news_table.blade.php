@extends('dashboard.dashboard')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">

    <div class="container">
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <header class="w3-bar w3-green">
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>
                    <div>
                        <button class="w3-bar-item w3-button edit-user-btn" onclick="openAction('EDITNews')">Edit News</button>
                        <button class="w3-bar-item w3-button " onclick="openAction('VIEWNews')">VIEW News</button>
                        <button class="w3-bar-item w3-button" onclick="openAction('DELETENews')">Delete News</button>
                    </div>
                </header>
                <div id="EDITNews" class="w3-container actions" style="display:none"
                    data-asset-url="{{ asset('storage/') }}">

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

                    <form method="POST">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editActionButtons = document.querySelectorAll(".action-user-btn");
            const editForm = document.getElementById("EDITForm");
            const viewForm = document.getElementById("viewForm");
            const deleteForm = document.getElementById("deleteForm");

            const updateRoute = "{{ route('announcements.update', ['announcement' => ':announcementId']) }}";
            const showRoute = "{{ route('announcements.show', ['announcement' => ':announcementId']) }}";
            const destroyRoute = "{{ route('announcements.destroy', ['announcement' => ':announcementId']) }}";

            function attachEventListener(button, announcementId) {
                button.addEventListener("click", function() {
                    const editFormAction = updateRoute.replace(':announcementId', announcementId);
                    const viewFormAction = showRoute.replace(':announcementId', announcementId);
                    const deleteFormAction = destroyRoute.replace(':announcementId', announcementId);

                    editForm.setAttribute("action", editFormAction);
                    viewForm.setAttribute("action", viewFormAction);
                    deleteForm.setAttribute("action", deleteFormAction);

                    const editAnnouncementsDiv = document.getElementById("EDITAnnouncements");
                    editAnnouncementsDiv.innerHTML = editAnnouncementsInclude;

                    document.getElementById("show-news-id").value = announcementId;
                    document.getElementById("delete-news-id").value = announcementId;
                });
            }

            editActionButtons.forEach(button => {
                const announcementId = button.getAttribute("data-announcement-id");
                attachEventListener(button, announcementId);
            });
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
