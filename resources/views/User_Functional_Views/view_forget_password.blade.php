@extends('welcome')

@section('content')
<div class="heading white-heading">
    Forget Password
</div>
    <div class="container">
        <h2>Change Password</h2>
        <form method="POST" action="{{ route('changeForgetPassword', $email) }}">
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
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
@endsection
