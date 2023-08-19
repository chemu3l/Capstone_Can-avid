@extends('dashboard.dashboard')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">

    <div class="container">
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
