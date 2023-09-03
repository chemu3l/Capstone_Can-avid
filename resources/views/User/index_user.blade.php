@extends('dashboard.dashboard')

@section('content')
    <link href="{{ asset('css') }}">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
    {{ session('error') }}
</div> @endif
<a href="{{ route('users.create') }}" class="btn btn-info btn-lg">Add User</a>

    <h1>User Table </h1>
    <table class="table table-x1 table-striped table-success ">
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
                <th scope="col">EDIT</th>
                <th scope="col">VIEW</th>
                <th scope="col">DELETE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->position }}</td>
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->user->role }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>
                        @if ($user->images)
                            <img src="{{ asset('storage/' . $user->images) }}" alt="Profile Image"
                                style="max-width: 50px; border-radius: 50%;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">EDIT</a>
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-primary">VIEW</a>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
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
@endsection
