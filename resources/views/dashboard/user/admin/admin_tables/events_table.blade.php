@extends('dashboard.user.admin.admin_dashboard')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/admin/table.css')}}">

<div class="container">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"
        id="create_user">Create</button>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
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
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror" name="age"
                                id="age" value="{{ old('age') }}" required>
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
                                <!-- Add more options as needed -->
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
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="picture">Upload a Picture:</label>
                            <input type="file" class="form-control-file @error('picture') is-invalid @enderror"
                                name="picture" id="picture" accept="image/*" required>
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
    <h1>Events Table </h1>
</div>
@endsection