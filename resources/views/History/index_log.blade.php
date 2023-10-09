@extends('dashboard.sidebar')

@section('sub-content')
    <div class="tables-administer">
        <div class="header-tables-page">
            <h1>Activity Logs</h1>
            <form action="{{ route('logs_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>

        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Type</th>
                    <th scope="col">Changed from</th>
                    <th scope="col">Changed into</th>
                    <th scope="col">Activity by</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->Action }}</td>
                        <td>{{ $log->Type }}</td>
                        <td>{{ $log->Old_data }}</td>
                        <td>{{ $log->New_data }}</td>
                        <td>{{ $log->profile->name }}</td>
                        <td>{{ date('m-d-Y', strtotime($log->Date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
