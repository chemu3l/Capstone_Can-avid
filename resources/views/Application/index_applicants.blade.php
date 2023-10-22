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
            <h1>Applicants Table </h1>
            <form action="{{ route('applicant_Filter') }}" method="GET" id="searchForm" style="margin-buttom:20px;">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
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
                        <td>{{ $applicant->applicant_name }}</td>
                        <td>{{ $applicant->applicant_email }}</td>
                        <td>{{ $applicant->career->career_position }}</td>
                        <td>{{ date('m-d-Y', strtotime($applicant->date_applied)) }}</td>
                        <td>
                            <a href="{{ route('applicants.show', $applicant) }}" class="btn btn-primary">VIEW
                                Application</a>
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
@endsection
