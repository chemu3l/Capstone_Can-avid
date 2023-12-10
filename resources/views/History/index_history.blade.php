@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <h1>Your History</h1>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Actions</th>
                    <th scope="col" style="padding:10px;">Type</th>
                    <th scope="col" style="padding:10px;">Changed from</th>
                    <th scope="col" style="padding:10px;">Changed into</th>
                    <th scope="col" style="padding:10px;">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td style="padding:10px;">{{ $history->Action }}</td>
                        <td style="padding:10px;">{{ $history->Type }}</td>
                        <td style="padding:10px;">{{ $history->Old_data }}</td>
                        <td style="padding:10px;">{{ $history->New_data }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($history->Date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
