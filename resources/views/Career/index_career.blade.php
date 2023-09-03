@extends('dashboard.dashboard')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <div class="container">
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
<a href="{{ route('careers.create') }}" class="btn btn-info btn-lg">Add  Career</a>
        <h1>Career Table</h1>
        <table class="table table-x1 table-striped table-dark ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Career Position</th>
                    <th scope="col">Career Description</th>
                    <th scope="col">Career Uploaded</th>
                    <th scope="col">Career Requirements</th>
                    <th scope="col">Career Uploader</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($careers as $career)
                    <tr>
                        <td>{{ $career->id }}</td>
                        <td>{{ $career->career_position }}</td>
                        <td>{{ $career->career_description }}</td>
                        <td>{{ date('m-d-Y', strtotime($career->career_uploaded)) }}</td>
                        <td>{{ $career->career_requirements }}</td>
                        <td>{{ $career->profile->name }}</td>
                        <td>
                            <a href="{{ route('careers.edit', $career) }}"
                                class="btn btn-primary">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('careers.show', $career) }}"
                                class="btn btn-primary">VIEW</a>
                        </td>
                        <td>
                            <form action="{{ route('careers.destroy', $career) }}" method="POST">
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
    <script src="{{ asset('js/home_function/menu.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
