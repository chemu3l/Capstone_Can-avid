@extends('home')

@section('sub-content')
    <div class="tables-administer">
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

        <div class="header-tables-page"  style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('users.create') }}" class="btn btn-info btn-lg" style="background-color: green; color:white;">Add
                User</a>
            <h1>User Table</h1>
            <form action="{{ route('user_Filter') }}" method="GET" id="searchForm" class="search-form">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="sub2">
            <div class="item1">
                <p class="heading2">Total Users</p>
                @if (count($profiles) > 0)
                    <p class="value_management" id="profileCountByDepartment">{{ count($profiles) }}</p>
                @else
                    <p>No users found.</p>
                @endif
                <select id="departmentSelect"
                    style="width: 90%; background-color:#285430; color: black; border-color: #285430; font-size: 12px;">
                    <option value="Mathematics">By Mathematics Department</option>
                    <option value="Science">By Science Department</option>
                    <option value="English">By English Department</option>
                    <option value="Filipino">By Filipino Department</option>
                    <option value="EdukPanlipunan">By E.S.P & Araling Panlipunan Department</option>
                    <option value="Tle">By TLE Department</option>
                    <option value="Mapeh">By Mapeh Department</option>
                    <option value="SHS">By Senior High School Department</option>
                    <option value="ALS">By Alternative Learning System Department</option>
                    <option value="Non-teaching">By Non-Teaching Department</option>
                </select>
            </div>

            <div class="item2">
                <p class="heading2">Total Users by Gender</p>
                @if (count($profiles) > 0)
                    <p class="value_management" id="profileCountByGender">{{ count($profiles) }}</p>
                @else
                    <p>No users found.</p>
                @endif
                <select id="genderSelect"
                    style="width: 90%; background-color:rgb(8, 88, 12); color: white; border-color:rgb(8, 88, 12); font-size: 12px;">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>


            <div class="item3">
                <p class="heading2">Total Users by Role</p>
                @if (count($profiles) > 0)
                    <p class="value_management" id="profileCountByRole">{{ count($profiles) }}</p>
                @else
                    <p>No users found.</p>
                @endif
                <select id="roleSelect"
                    style="width: 90%; background-color:#379237; color: black; border-color:#379237; font-size: 12px;">
                    <option value="Admin">Admin</option>
                    <option value="Principal">Principal</option>
                    <option value="Registrar">Registrar</option>
                    <option value="Faculty">Faculty & Staff</option>
                </select>
            </div>
            <div class="item4">
                <p class="heading2">Total Users</p>
                @if (count($profiles) > 0)
                    <p class="value_management">{{ count($profiles) }}</p>
                @else
                    <p>No users found.</p>
                @endif
            </div>

        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Position</th>
                    <th scope="col">Department</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">
                        <center>images</center>
                    </th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $profile->user->email }}</td>
                        <td>{{ $profile->name }}</td>
                        <td>{{ $profile->age }}</td>
                        <td>{{ $profile->gender }}</td>
                        <td>{{ $profile->position }}</td>
                        <td>{{ $profile->department }}</td>
                        <td>{{ $profile->user->role }}</td>
                        <td>{{ $profile->phone_number }}</td>
                        <td>
                            @if ($profile->images)
                                <img src="{{ asset('storage/' . $profile->images) }}" alt="Profile Image"
                                    style="max-width: 50px; border-radius: 50%;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $profile) }}" class="btn btn-primary"
                                style="background-color: green; color:white;">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('users.show', $profile) }}" class="btn btn-primary"
                                style="background-color: green">VIEW</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $profile) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this User?')">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function updateProfileCountByDepartment(selectedDepartment) {
            const filteredProfiles = profilesByDepartment.filter(profile => profile.department === selectedDepartment);
            profileCountDepartmentElement.textContent = filteredProfiles.length;
        }

        const departmentSelect = document.getElementById('departmentSelect');
        const profileCountDepartmentElement = document.getElementById('profileCountByDepartment');
        const profilesByDepartment = @json($profiles);

        // Function to update the profile count based on the selected department
        departmentSelect.addEventListener('change', function() {
            const selectedDepartment = departmentSelect.value;
            updateProfileCountByDepartment(selectedDepartment);
        });

        // Initial page load, use 'Mathematics' as the default department
        const initialDepartment = 'Mathematics';
        updateProfileCountByDepartment(initialDepartment);
    </script>

    <script>
        function updateProfileCountByGender(selectedGender) {
            const filteredProfiles = profilesByGender.filter(profile => profile.gender === selectedGender);
            profileCountGenderElement.textContent = filteredProfiles.length;
        }

        const genderSelect = document.getElementById('genderSelect');
        const profileCountGenderElement = document.getElementById('profileCountByGender');
        const profilesByGender = @json($profiles);

        genderSelect.addEventListener('change', function() {
            const selectedGender = genderSelect.value;
            updateProfileCountByGender(selectedGender);
        });

        const initialGender = 'Male';
        updateProfileCountByGender(initialGender);
    </script>

    <script>
        function updateProfileCountByRole(selectedRole) {
            const filteredProfiles = profilesByRole.filter(profile => profile.user.role === selectedRole);
            profileCountRoleElement.textContent = filteredProfiles.length;
        }
        const roleSelect = document.getElementById('roleSelect');
        const profileCountRoleElement = document.getElementById('profileCountByRole');
        const profilesByRole = @json($profiles);

        // Function to update the profile count based on the selected department
        roleSelect.addEventListener('change', function() {
            const selectedRole = roleSelect.value;
            updateProfileCountByRole(selectedRole);
        });

        // Initial page load, use 'Mathematics' as the default department
        const initialRole = 'Admin';
        updateProfileCountByRole(initialRole);
    </script>
@endsection
