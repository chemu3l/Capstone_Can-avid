@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <h1>Your History</h1>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Type</th>
                    <th scope="col">Changed from</th>
                    <th scope="col">Changed into</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td>{{ $history->Action }}</td>
                        <td>{{ $history->Type }}</td>
                        <td>{{ $history->Old_data }}</td>
                        <td>{{ $history->New_data }}</td>
                        <td>{{ date('m-d-Y', strtotime($history->Date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
