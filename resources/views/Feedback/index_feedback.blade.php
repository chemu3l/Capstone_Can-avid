@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <h1>Feedback</h1>
        <table class="feedback_table">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Name</th>
                    <th scope="col" style="padding:10px;">Email</th>
                    <th scope="col" style="padding:10px;">Message</th>
                    <th scope="col" style="padding:10px;">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td style="padding:10px;">{{ $feedback->name }}</td>
                        <td style="padding:10px;">{{ $feedback->email }}</td>
                        <td style="padding:10px;">{{ $feedback->message }}</td>
                        <td style="padding:10px;">{{ date('m-d-Y', strtotime($feedback->date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
