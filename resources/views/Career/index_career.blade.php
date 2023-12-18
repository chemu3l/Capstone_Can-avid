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
        <div class="header-tables-page" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('careers.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%;">Add Career</a>
            <h1>Career Table</h1>
            <form action="{{ route('career_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" style="background-color: #56C46F">Search</button>
            </form>
        </div>
        <table
            style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; padding-right:40%;">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Position</th>
                    <th scope="col" style="padding:10px;">Description</th>
                    <th scope="col" style="padding:10px;">Uploaded</th>
                    <th scope="col" style="padding:10px;">Requirements</th>
                    <th scope="col" style="padding:10px;">Status</th>
                    <th scope="col" style="padding:10px;">Uploader</th>
                    <th scope="col" style="padding:10px;">Edit</th>
                    <th scope="col" style="padding:10px;">View</th>
                    <th scope="col" style="padding:10px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($careers as $career)
                    <tr>
                        <td style="padding:10px;">{{ $career->career_position }}</td>
                        <td style="padding:10px;">{{ $career->career_description }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($career->career_uploaded)) }}</td>
                        <td style="padding:10px;">{{ $career->career_requirements }}</td>
                        @if ($career->status == 'Posted')
                            <td style="padding:10px;">
                                <div style="background-color: #7A9D54">
                                    <center>{{ $career->status }}</center>
                                </div>
                            </td>
                        @elseif ($career->status == 'Registrar Verified')
                            <td style="padding:10px;">
                                <div style="background-color: #EEE2DE">
                                    <center>{{ $career->status }}</center>
                                </div>
                            </td>
                        @else
                            <td style="padding:10px;">
                                <div style="background-color: #4F709C">
                                    <center>{{ $career->status }}</center>
                                </div>
                            </td>
                        @endif
                        <td style="padding:10px;">{{ $career->profile->name }}</td>
                        <td style="padding:10px;">
                            <a href="{{ route('careers.edit', $career) }}" class="btn btn-primary"
                                style="background-color: green">EDIT</a>
                        </td>
                        <td style="padding:10px;">
                            <a href="{{ route('careers.show', $career) }}" class="btn btn-primary"
                                style="background-color: green">VIEW</a>
                        </td>
                        <td style="padding:10px;">
                            <form action="{{ route('careers.destroy', $career) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this career?')">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
