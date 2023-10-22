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
            <a href="{{ route('careers.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%;">Add Career</a>
            <h1>Career Table</h1>
            <form action="{{ route('career_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table class="carrer_tables table-responsive" style="background-color: #A8DF8E; font-size: 12px">
            <thead>
                <tr>
                    <th scope="col">Career Position</th>
                    <th scope="col">Career Description</th>
                    <th scope="col">Career Uploaded</th>
                    <th scope="col">Career Requirements</th>
                    <th scope="col">Status</th>
                    <th scope="col">Career Uploader</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">VIEW</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($careers as $career)
                    <tr>
                        <td>{{ $career->career_position }}</td>
                        <td>{{ $career->career_description }}</td>
                        <td>{{ date('m-d-Y', strtotime($career->career_uploaded)) }}</td>
                        <td>{{ $career->career_requirements }}</td>
                        @if ($career->status == 'Posted')
                            <td>
                                <div style="background-color: #7A9D54">
                                    <center>{{ $career->status }}</center>
                                </div>
                            </td>
                        @elseif ($career->status == 'Registrar Verified')
                            <td>
                                <div style="background-color: #EEE2DE">
                                    <center>{{ $career->status }}</center>
                                </div>
                            </td>
                        @else
                            <td>
                                <div style="background-color: #4F709C">
                                    <center>{{ $career->status }}</center>
                                </div>
                            </td>
                        @endif
                        <td>{{ $career->profile->name }}</td>
                        <td>
                            <a href="{{ route('careers.edit', $career) }}" class="btn btn-primary"
                                style="background-color: green">EDIT</a>
                        </td>
                        <td>
                            <a href="{{ route('careers.show', $career) }}" class="btn btn-primary"
                                style="background-color: green">VIEW</a>
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
@endsection
