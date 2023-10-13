@extends('welcome')

@section('content')
<div class="headers_text_title">
    Send Email to Change Password
</div>
    <center>
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
        <form method="POST" action="{{ route('ForgetPassword') }}" style="margin-top: 20px; margin-bottom: 20px;">
            @csrf
            <input type="email" placeholder="Type your Email here..." name="email">
            <button class="btn btn-outline-light btn-lg px-2" style="color: black;" type="submit">Send Email</button>
        </form>
    </center>
@endsection
