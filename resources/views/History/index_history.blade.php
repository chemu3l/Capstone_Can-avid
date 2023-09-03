@extends('dashboard.dashboard')

@section('content')

<h1>Your </h1>
    <table class="table table-x1 table-striped table-dark ">
        <thead>
            <tr>
                <th scope="col">Actions</th>
                <th scope="col">Type</th>
                <th scope="col">Changed form</th>
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
@endsection
