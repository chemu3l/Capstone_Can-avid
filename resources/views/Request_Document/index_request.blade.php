@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <div class="header-tables-page" style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Requests Table </h1>
            <form action="{{ route('requested_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" style="background-color: #56C46F">Search</button>
            </form>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Searchable ID</th>
                    <th scope="col" style="padding:10px;">Document</th>
                    <th scope="col" style="padding:10px;">Student Name</th>
                    <th scope="col" style="padding:10px;">Requester Name</th>
                    <th scope="col" style="padding:10px;">Date to Get</th>
                    <th scope="col" style="padding:10px;">Requester Email</th>
                    <th scope="col" style="padding:10px;">Requested At</th>
                    <th scope="col" style="padding:10px;">DELETE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requested as $request)
                    <tr>
                        <td style="padding:10px;">{{ $request->search_id }}</td>
                        <td style="padding:10px;">{{ $request->Document }}</td>
                        <td style="padding:10px;">{{ $request->Student_Name }}</td>
                        <td style="padding:10px;">{{ $request->Requester_Name }}</td>
                        <td style="padding:10px;">{{ $request->Date_to_Get }}</td>
                        <td style="padding:10px;">{{ $request->Requester_Email }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($request->Requested_at)) }}</td>
                        <td style="padding:10px;">
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
