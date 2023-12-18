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
                <button type="submit" style="background-color: #56C46F">Search</button>
            </form>
        </div>

        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Name</th>
                    <th scope="col" style="padding:10px;">Email</th>
                    <th scope="col" style="padding:10px;">Position</th>
                    <th scope="col" style="padding:10px;">Date</th>
                    <th scope="col" style="padding:10px;">View</th>
                    <th scope="col" style="padding:10px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applicants as $applicant)
                    <tr>
                        <td style="padding:10px;">{{ $applicant->applicant_name }}</td>
                        <td style="padding:10px;">{{ $applicant->applicant_email }}</td>
                        <td style="padding:10px;">{{ $applicant->career->career_position }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($applicant->date_applied)) }}</td>
                        <td style="padding:10px;">
                            <a href="{{ route('applicants.show', $applicant) }}" class="btn btn-primary">View
                                Application</a>
                        </td>
                        <td style="padding:10px;">
                            <form action="{{ route('applicants.destroy', $applicant) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this application?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
