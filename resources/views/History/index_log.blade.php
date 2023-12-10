@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <div class="header-tables-page" style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Activity Logs</h1>
            <form action="{{ route('logs_Filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" style="background-color: #56C46F">Search</button>
            </form>
        </div>

        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Actions</th>
                    <th scope="col" style="padding:10px;">Type</th>
                    <th scope="col" style="padding:10px;">Changed from</th>
                    <th scope="col" style="padding:10px;">Changed into</th>
                    <th scope="col" style="padding:10px;">Activity by</th>
                    <th scope="col" style="padding:10px;">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td style="padding:10px;">{{ $log->Action }}</td>
                        <td style="padding:10px;">{{ $log->Type }}</td>
                        <td style="padding:10px;">{{ $log->Old_data }}</td>
                        <td style="padding:10px;">{{ $log->New_data }}</td>
                        <td style="padding:10px;">{{ $log->profile->name }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($log->Date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
