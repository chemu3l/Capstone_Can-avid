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
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#CreateUser"
            id="create_user">Create</button>
        <!-- #Create User -->
        <div class="modal fade" id="CreateUser" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create User</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- #End Create User -->

        </table>
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <header class="w3-bar w3-green">
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>
                    <div>
                        <button class="w3-bar-item w3-button edit-user-btn" onclick="openAction('EDITUser')">Edit
                            User</button>
                        <button class="w3-bar-item w3-button " onclick="openAction('VIEWUser')">VIEW User</button>
                        <button class="w3-bar-item w3-button" onclick="openAction('DELETEUser')">Delete User</button>
                    </div>
                </header>
                <div id="EDITUser" class="w3-container actions">

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
                            id="edit-user-id" value="{{ old('id') }}" required readonly>

                </div>

                <div id="VIEWUser" class="w3-container actions viewUSER" style="display:none">
                    <div class="col">
                        <span class="span_view_user">ID: </span><span class="value" id="view-user-id"></span><br>
                        <span class="span_view_user">Email: </span><span class="value" id="view-user-email"></span><br>
                        <span class="span_view_user">Complete Name: </span><span class="value"
                            id="view-user-name"></span><br>
                        <span class="span_view_user">Age: </span><span class="value" id="view-user-age"></span><br>
                        <span class="span_view_user">Gender: </span><span class="value"
                            id="view-user-gender"></span><br>
                        <span class="span_view_user">Position: </span><span class="value"
                            id="view-user-position"></span><br>
                        <span class="span_view_user">Department: </span><span class="value"
                            id="view-user-department"></span><br>
                        <span class="span_view_user">Role: </span><span class="value" id="view-user-role"></span><br>
                        <span class="span_view_user">Phone Number: </span><span class="value"
                            id="view-user-phone_number"></span><br>
                    </div>
                    <div class="col">
                        <img id="view-user-picture" src="" alt="User Picture"><br><br>
                    </div>
                </div>

                <div id="DELETEUser" class="w3-container actions" style="display:none">
                    <h2>Other actions</h2>


                    <button>Reset Password</button>


                    <form action="{{ route('delete.user') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                            id="delete-user-id" value="{{ old('id') }}" required readonly>
                            <input type="hidden" name="file_path" id="delete-file-path">
                        <button type="submit">DELETE</button>
                    </form>


                    <br><br>
                </div>
            </div>


        </div>
    </div>
    <script src="{{ asset('js/home_function/menu.js') }}"></script>
    <script src="{{ asset('js/User/edit_user.js') }}"></script>
    <script src="{{ asset('js/User/view_user.js') }}"></script>
    <script src="{{ asset('js/User/delete_user.js') }}"></script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
