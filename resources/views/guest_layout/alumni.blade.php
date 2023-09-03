@extends('welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/alumni.css') }}">
    <div class="container">
        <h1>Alumni List</h1>
        <form action="{{ route('filtered_alumni') }}" method="GET">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
        <br>
        <table class="table table-x1 table-striped table-success">
            <thead>
                <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Section</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">Class Year</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnis as $alumnus)
                    <tr>
                        <td>{{ $alumnus->student_name }}</td>
                        <td>{{ $alumnus->section }}</td>
                        <td>{{ $alumnus->alumni_specialization }}</td>
                        <td>{{ $alumnus->class_year }}</td>
                    </tr>
                    {{-- I need Pagination Here and Like Search for my input --}}
                @endforeach
            </tbody>
        </table>
        {{ $alumnis->links() }} <!-- Pagination links -->
    </div>
@endsection
