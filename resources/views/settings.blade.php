@extends('home')

@section('content')
    <div class="container p-0">
        <h1 class="h3 mb-3">Settings</h1>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-5 col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account"
                            role="tab" style="background-color: green; color:white">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab"
                            style="background-color: green; color:white">
                            Password
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <div class="card" style="background-color: #E8FFCE">
                            <div class="card-header" style="background-color: green; color:white">
                                <h5 class="card-title mb-0">Public info</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="inputEmail">Email</label>
                                            <input type="text" class="form-control" id="view-email"
                                                value="{{ Auth::guard('web')->user()->email }}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRole">Role</label>
                                            <input class="form-control" id="view-role"
                                                value="{{ Auth::guard('web')->user()->role }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="Andrew Jones"
                                                src="{{ asset('storage/' . Auth::guard('web')->user()->profile->images) }}"
                                                class="rounded-circle img-responsive mt-2" width="128" height="128">
                                            <div class="mt-2" class="profile-picture">
                                                <span class="btn btn-primary update_profile">
                                                    <form action="{{ route('update_profile_picture') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="file" name="profile_picture" accept="image/*"
                                                            id="profile-pic">
                                                        @error('profile_picture')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <br />
                                                        <button type="submit">Update Profile Picture</button>
                                                    </form>
                                                </span>
                                            </div>
                                            <small>For best results, use an image at least 128px by 128px in .jpg
                                                format</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="background-color: #E8FFCE">
                            <div class="card-header" style="background-color: green; color:white">
                                <h5 class="card-title mb-0">Private info</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($profiles as $profile)
                                    <form action="{{ route('update_user', $profile) }}" method="POST"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="complete-name">Complete Name</label>
                                            <input type="text" class="form-control" id="complete-name"
                                                value="{{ $profile->name }}" name="name">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age"
                                                value="{{ $profile->age }}" name="age">
                                            @error('age')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <input type="text" class="form-control" id="gender"
                                                value="{{ $profile->gender }}" name="gender" readonly>
                                            @error('gender')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input type="text" class="form-control" id="position"
                                                value="{{ $profile->position }}" name="position">
                                            @error('position')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="department">Department:</label>
                                                <select class="form-control @error('department') is-invalid @enderror"
                                                    name="department" id="department">
                                                    <option value="Mathematics"
                                                        {{ old('department', $profile->department) === 'Mathematics' ? 'selected' : '' }}>
                                                        Mathematics Department</option>
                                                    <option value="Science"
                                                        {{ old('department', $profile->department) === 'Science' ? 'selected' : '' }}>
                                                        Science Department</option>
                                                    <option value="English"
                                                        {{ old('department', $profile->department) === 'English' ? 'selected' : '' }}>
                                                        English Department</option>
                                                    <option value="Filipino"
                                                        {{ old('department', $profile->department) === 'Filipino' ? 'selected' : '' }}>
                                                        Filipino Department</option>
                                                    <option value="EdukPanlipunan"
                                                        {{ old('department', $profile->department) === 'EdukPanlipunan' ? 'selected' : '' }}>
                                                        E.S.P & Araling Panlipunan Department</option>
                                                    <option value="TLE"
                                                        {{ old('department', $profile->department) === 'TLE' ? 'selected' : '' }}>
                                                        TLE Department</option>
                                                    <option value="Mapeh"
                                                        {{ old('department', $profile->department) === 'Mapeh' ? 'selected' : '' }}>
                                                        Mapeh Department</option>
                                                    <option value="SHS"
                                                        {{ old('department', $profile->department) === 'SHS' ? 'selected' : '' }}>
                                                        Senior High School Department</option>
                                                    <option value="ALS"
                                                        {{ old('department', $profile->department) === 'ALS' ? 'selected' : '' }}>
                                                        Alternative Learning System Department</option>
                                                    <option value="Non-teaching"
                                                        {{ old('department', $profile->department) === 'Non-teaching' ? 'selected' : '' }}>
                                                        Non-Teaching Department</option>
                                                </select>
                                                @error('department')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="phone_number">Phone number</label>
                                                <input type="tel" class="form-control" id="phone_number"
                                                    value="{{ $profile->phone_number }}" name="phone_number">
                                                @error('phone_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary"
                                            style="background-color: green; color:white">Save changes</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>

                                <form action="{{ route('ChangePassword', Auth::user()->profile) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputPasswordCurrent">Current password</label>
                                        <input type="password" name="current_password" class="form-control"
                                            id="inputPasswordCurrent">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew">New password</label>
                                        <input type="password" name="new_password" class="form-control"
                                            id="inputPasswordNew">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew2">Confirm password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            id="inputPasswordNew2">
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        style="background-color: green; color:white">Save changes</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
