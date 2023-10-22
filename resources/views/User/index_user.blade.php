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

        <div class="header-tables-page">
            <a href="{{ route('users.create') }}" class="btn btn-info btn-lg" style="background-color: green; color:white;">Add
                User</a>
            <h1>User Table</h1>
            <form action="{{ route('user_Filter') }}" method="GET" id="searchForm" class="search-form">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
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
                                    onclick="return confirm('Are you sure you want to delete this announcement?')">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
