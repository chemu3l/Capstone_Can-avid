@extends('dashboard.sidebar')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('users.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom: 2%;">Go
            Back</a>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Complete Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    value="{{ old('name') }}" required>
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    id="email" value="{{ old('email') }}" required>
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control @error('age') is-invalid @enderror" name="age" id="age"
                    value="{{ old('age') }}" required>
                <span class="text-danger">
                    @error('age')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label>Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                        id="gender_male" value="Male" {{ old('gender') === 'Male' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="gender_male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                        id="gender_female" value="Female" {{ old('gender') === 'Female' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="gender_female">Female</label>
                </div>
            </div>
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
                    id="position" value="{{ old('position') }}" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control @error('department') is-invalid @enderror" name="department" id="department"
                    required>
                    <option value="">Select Department</option>
                    <option value="Mathematics" {{ old('department') === 'Mathematics' ? 'selected' : '' }}>Mathematics
                        Department
                    </option>
                    <option value="Science" {{ old('department') === 'Science' ? 'selected' : '' }}>Science
                        Department</option>
                    <option value="English" {{ old('department') === 'English' ? 'selected' : '' }}>English
                        Department</option>
                    <option value="Filipino" {{ old('department') === 'Filipino' ? 'selected' : '' }}>
                        Filipino Department</option>
                    <option value="EdukPanlipunan" {{ old('department') === 'EdukPanlipunan' ? 'selected' : '' }}>E.S.P &
                        Araling
                        Panlipunan Department</option>
                    <option value="Tle" {{ old('department') === 'Tle' ? 'selected' : '' }}>TLE
                        Department</option>
                    <option value="Mapeh" {{ old('department') === 'Mapeh' ? 'selected' : '' }}>Mapeh
                        Department</option>
                    <option value="SHS" {{ old('department') === 'SHS' ? 'selected' : '' }}>Senior High
                        School Department</option>
                    <option value="ALS" {{ old('department') === 'ALS' ? 'selected' : '' }}>Alternative
                        Learning System Department</option>
                    <option value="Non-teaching" {{ old('department') === 'Non-teaching' ? 'selected' : '' }}>Non-Teaching
                        Department</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                    <option value="">Select Role</option>
                    <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Principal" {{ old('role') === 'Principal' ? 'selected' : '' }}>
                        Principal
                    </option>
                    <option value="Registrar" {{ old('role') === 'Registrar' ? 'selected' : '' }}>
                        Registrar
                    </option>
                    <option value="Faculty" {{ old('role') === 'Faculty' ? 'selected' : '' }}>Faculty
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                    id="phone_number" value="{{ old('phone_number') }}" required>
                <span class="text-danger">
                    @error('phone_number')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="picture">Upload a Picture:</label>
                <input type="file" class="form-control-file @error('picture') is-invalid @enderror" name="picture"
                    id="picture" accept="image/*" required>
                <span class="text-danger">
                    @error('picture')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block" style="background-color: green;">Submit</button>
            </div>
        </form>
    </div>
@endsection
