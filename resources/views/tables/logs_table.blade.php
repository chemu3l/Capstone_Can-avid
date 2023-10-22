@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <h1>Logs Table </h1>
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
                    <th scope="col">Role</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">images</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $profile->id }}</td>
                        <td>{{ $profile->user->email }}</td>
                        <td>{{ $profile->name }}</td>
                        <td>{{ $profile->age }}</td>
                        <td>{{ $profile->gender }}</td>
                        <td>{{ $profile->position }}</td>
                        <td>{{ $profile->department }}</td>
                        <td>{{ $profile->user->role }}</td>
                        <td>{{ $profile->phone_number }}</td>
                        <td>
                            <button onclick="document.getElementById('id01').style.display='block'"
                                class="w3-button w3-light-green action-user-btn" data-toggle="actions" data-target="#id01"
                                data-user="{{ json_encode($profile) }}">Actions</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
