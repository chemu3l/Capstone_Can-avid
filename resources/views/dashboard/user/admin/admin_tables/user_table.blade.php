@extends('dashboard.user.admin.admin_dashboard')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/admin/table.css')}}">

<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
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
                    <form action="{{ route('user.create_user') }}" method="POST" enctype="multipart/form-data">
                        @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="name">Complete Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') }}" required>
                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') }}" required>
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror" name="age"
                                id="age" value="{{ old('age') }}" required>
                            <span class="text-danger">@error('age'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label>Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                                    name="gender" id="gender_male" value="Male"
                                    {{ old('gender') === 'Male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                                    name="gender" id="gender_female" value="Female"
                                    {{ old('gender') === 'Female' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                name="position" id="position" value="{{ old('position') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="department">Department:</label>
                            <select class="form-control @error('department') is-invalid @enderror" name="department"
                                id="department" required>
                                <option value="">Select Department</option>
                                <option value="HR" {{ old('department') === 'HR' ? 'selected' : '' }}>Human Resources
                                </option>
                                <option value="IT" {{ old('department') === 'IT' ? 'selected' : '' }}>Information
                                    Technology</option>
                                <option value="Finance" {{ old('department') === 'Finance' ? 'selected' : '' }}>Finance
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" id="role"
                                required>
                                <option value="">Select Role</option>
                                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Principal" {{ old('role') === 'Principal' ? 'selected' : '' }}>Principal
                                </option>
                                <option value="Registrar" {{ old('role') === 'Registrar' ? 'selected' : '' }}>Registrar
                                </option>
                                <option value="Faculty" {{ old('role') === 'Faculty' ? 'selected' : '' }}>Faculty
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="picture">Upload a Picture:</label>
                            <input type="file" class="form-control-file @error('picture') is-invalid @enderror"
                                name="picture" id="picture" accept="image/*" required>
                            <span class="text-danger">@error('picture'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- #End Create User -->
    <h1>User Table </h1>
    <table class="table table-x1 table-striped table-dark ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Position</th>
                <th scope="col">Department</th>
                <th scope="col">Phone Number</th>
                <th scope="col">images</th>
                <th scope="col" colspan="3">Password-Reset, VIEW & DELETE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $profile)
            <tr>
                <td>{{ $profile->id }}</td>
                <td>{{ $profile->email }}</td>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->age }}</td>
                <td>{{ $profile->gender }}</td>
                <td>{{ $profile->position }}</td>
                <td>{{ $profile->department }}</td>
                <td>{{ $profile->phone_number }}</td>
                <td>
                    @if ($profile->images)
                    <img src="{{ asset('storage/'.$profile->images) }}" alt="Profile Image"
                        style="max-width: 50px; border-radius: 50%;">
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-warning">Password-Reset</button>
                    <button type="button" class="btn btn-primary edit-user-btn" data-toggle="modal"
                        data-target="#EDITUser" data-user="{{ json_encode($profile) }}">VIEW</button>
                <td>
                    <form action="{{ route('user.delete.user', ['id' => $profile->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-user-btn" style="background-color: #DC0000; width:100px; height: 35px; border-radius: 5px;">DELETE</button>
                    </form>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- UPDATE User Modal -->
    <div class="modal fade" id="EDITUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">View User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update_user') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <p><b>Complete Name:</b>&nbsp;&nbsp;<h7 id="edit-user-name" name="name"></h7>
                            </p>
                        </div>
                        <div class="form-group">
                            <p><b>Email:</b>&nbsp;&nbsp;<h7 id="edit-user-email" name="email"></h7>
                            </p>
                        </div>
                        <div class="form-group">
                            <p><b>Gender:</b>&nbsp;&nbsp;<h7 id="edit-user-gender" name="gender"></h7>
                            </p>
                        </div>
                        <div class="form-group">
                            <p><b>Age:</b>&nbsp;&nbsp;<h7 id="edit-user-age" name="age"></h7>
                            </p>
                        </div>
                        <div class="form-group">
                            <p><b>Position:</b>&nbsp;&nbsp;<h7 id="edit-user-position" name="position"></h7>
                            </p>
                        </div>

                        <div class="form-group">
                            <p><b>Department:</b>&nbsp;&nbsp;<h7 id="edit-user-department" name="department"></h7>
                            </p>
                        </div>
                        <div class="form-group">
                            <p><b>Role:</b>&nbsp;&nbsp;<h7 id="edit-user-role" name="role"></h7>
                            </p>
                        </div>

                        <div class="form-group">
                            <p><b>Phone Number:</b>&nbsp;&nbsp;<h7 id="edit-user-phone_number" name="role"></h7>
                        </div>

                        <div class="form-group">
                            <div id="baseURL" data-url="{{ asset('storage/') }}"></div>
                            <img id="profileImage" src="#" alt="Profile Image"
                                style="max-width: 100px; max-height: 100px;"><br>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                    <!-- Add other fields to edit here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Add Save changes button here -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Update User Modal -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    const editUserModal = document.getElementById("EDITUser");
    const baseURL = document.getElementById('baseURL').getAttribute('data-url');
    const profileImage = document.getElementById('profileImage');

    // Get the elements in the modal body to populate the data
    const editUserEmailElement = editUserModal.querySelector("#edit-user-email");
    const editUserNameElement = editUserModal.querySelector("#edit-user-name");
    const editUserGenderElement = editUserModal.querySelector("#edit-user-gender");
    const editUserAgeElement = editUserModal.querySelector("#edit-user-age");
    const editUserPositionElement = editUserModal.querySelector("#edit-user-position");
    const editUserDepartmentElement = editUserModal.querySelector("#edit-user-department");
    const editUserRoleElement = editUserModal.querySelector("#edit-user-role");
    const editUserPhoneNumberElement = editUserModal.querySelector("#edit-user-phone_number");

    // Add a click event listener to all "EDIT" buttons
    const editButtons = document.querySelectorAll(".edit-user-btn");
    editButtons.forEach((button) => {
        button.addEventListener("click", function() {
            const userData = JSON.parse(button.getAttribute("data-user"));

            editUserEmailElement.textContent = userData.email;
            editUserNameElement.textContent = userData.name;
            editUserGenderElement.textContent = userData.gender;
            editUserAgeElement.textContent = userData.age;
            editUserPositionElement.textContent = userData.position;
            editUserDepartmentElement.textContent = userData.department;
            editUserRoleElement.textContent = userData.role;
            editUserPhoneNumberElement.textContent = userData.phone_number;

            // Update the profile image src to include the baseURL and image filename
            profileImage.src = userData.image ? baseURL + '/' + userData.image : '';
            console.log(userData.image);
        });
    });
});
</script>
@endsection