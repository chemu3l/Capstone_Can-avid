@extends('dashboard.sidebar')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('users.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom: 1%;">Go
            Back</a>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Complete Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $user->profile->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $user->email }}" required disabled>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control @error('age') is-invalid @enderror" name="age"
                    value="{{ $user->profile->age }}" required>
            </div>
            <div class="form-group">
                <label>Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                        id="gender_male" value="Male" {{ $user->profile->gender === 'Male' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="gender_male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                        id="gender_female" value="Female" {{ $user->profile->gender === 'Female' ? 'checked' : '' }}
                        required>
                    <label class="form-check-label" for="gender_female">Female</label>
                </div>
            </div>
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position"
                    value="{{ $user->profile->position }}" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control @error('department') is-invalid @enderror" name="department" required>
                    <option disabled>Select Department</option>
                    <option value="Mathematics" {{ $user->profile->department === 'Mathematics' ? 'selected' : '' }}>
                        Mathematics Department</option>
                    <option value="Science" {{ $user->profile->department === 'Science' ? 'selected' : '' }}>Science
                        Department</option>
                    <option value="English" {{ $user->profile->department === 'English' ? 'selected' : '' }}>English
                        Department</option>
                    <option value="Filipino" {{ $user->profile->department === 'Filipino' ? 'selected' : '' }}>Filipino
                        Department</option>
                    <option value="EdukPanlipunan" {{ $user->profile->department === 'EdukPanlipunan' ? 'selected' : '' }}>
                        E.S.P & Araling
                        Panlipunan Department</option>
                    <option value="TLE" {{ $user->profile->department === 'Tle' ? 'selected' : '' }}>TLE Department
                    </option>
                    <option value="Mapeh" {{ $user->profile->department === 'Mapeh' ? 'selected' : '' }}>Mapeh
                        Department</option>
                    <option value="SHS" {{ $user->profile->department === 'SHS' ? 'selected' : '' }}>Senior High
                        School Department</option>
                    <option value="ALS" {{ $user->profile->department === 'ALS' ? 'selected' : '' }}>Alternative
                        Learning System Department</option>
                    <option value="Non-teaching" {{ $user->profile->department === 'Non-teaching' ? 'selected' : '' }}>
                        Non-Teaching Department</option>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option disabled>Select Role</option>
                    <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Principal" {{ $user->role === 'Principal' ? 'selected' : '' }}>Principal
                    </option>
                    <option value="Registrar" {{ $user->role === 'Registrar' ? 'selected' : '' }}>Registrar
                    </option>
                    <option value="Faculty" {{ $user->role === 'Faculty' ? 'selected' : '' }}>Faculty</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                    value="{{ $user->profile->phone_number }}" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-block" style="background-color: green;">Submit</button>
            </div>
        </form>
    </div>
@endsection
