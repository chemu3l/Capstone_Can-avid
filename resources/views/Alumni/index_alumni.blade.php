@extends('dashboard.dashboard')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/table.css') }}">

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
        <a href="{{ route('alumnis.create') }}" class="btn btn-info btn-lg">Add  Alumni</a>

        <h1>Alumni Table </h1>
        <table class="table table-x1 table-striped table-dark ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Section</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">Class Year</th>
                    <th scope="col">Uploaded by</th>
                    <th scope="col">Uploaded at</th>

                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnis as $alumni)
                    <tr>
                        <td>{{ $alumni->id }}</td>
                        <td>{{ $alumni->student_name }}</td>
                        <td>{{ $alumni->section }}</td>
                        <td>{{ $alumni->alumni_specialization }}</td>
                        <td>{{ $alumni->class_year }}</td>
                        <td>{{ $alumni->profile->name }}</td>
                        <td>{{ date('m-d-Y', strtotime($alumni->uploaded_at)) }}</td>
                        <td>
                            <a href="{{ route('alumnis.edit', $alumni) }}"
                                class="btn btn-primary">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('alumnis.show', $alumni) }}"
                                class="btn btn-primary">VIEW</a>
                        </td>
                        <td>
                            <form action="{{ route('alumnis.destroy', $alumni) }}" method="POST">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

