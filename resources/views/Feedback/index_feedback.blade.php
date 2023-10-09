@extends('dashboard.sidebar')

@section('sub-content')
    <div class="tables-administer">
        <h1>Feedback</h1>
        <table class="feedback_table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ date('m-d-Y', strtotime($feedback->date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
