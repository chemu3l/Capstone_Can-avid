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
        <h1>Applicants Table </h1>
        <table class="table table-x1 table-striped table-dark ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Applicants Name</th>
                    <th scope="col">Applicants Email</th>
                    <th scope="col">Job Applied</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applicants as $applicant)
                    <tr>
                        <td>{{ $applicant->id }}</td>
                        <td>{{ $applicant->applicant_name }}</td>
                        <td>{{ $applicant->applicant_email }}</td>
                        <td>{{ $applicant->career->career_position }}</td>
                        <td>{{ date('m-d-Y', strtotime($applicant->date_applied)) }}</td>
                        <td>
                            <a href="{{ route('applicants.edit', $applicant) }}"
                                class="btn btn-primary">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('applicants.show', $applicant) }}"
                                class="btn btn-primary">VIEW Application</a>
                        </td>
                        <td>
                            <form action="{{ route('applicants.destroy', $applicant) }}" method="POST">
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
