@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <div class="header-tables-page">
            <h1>Requests Table </h1>
            <form action="{{ route('requested_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col">Document</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Requester Name</th>
                    <th scope="col">Date to Get</th>
                    <th scope="col">Requester Email</th>
                    <th scope="col">Requested At</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requested as $request)
                    <tr>
                        <td>{{ $request->search_id }}</td>
                        <td>{{ $request->Document }}</td>
                        <td>{{ $request->Student_Name }}</td>
                        <td>{{ $request->Requester_Name }}</td>
                        <td>{{ $request->Date_to_Get }}</td>
                        <td>{{ $request->Requester_Email }}</td>
                        <td>{{ date('m-d-Y', strtotime($request->Requested_at)) }}</td>
                        <td>
                            <form action="{{ route('requests.destroy', $request) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this Request of Document?')">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
