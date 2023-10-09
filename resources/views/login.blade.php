@extends('welcome')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
<section class="vh-100 gradient-custom" id="loginDIV">
    <div class="container py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center h-10">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-transparent text-white" style="border-radius: .5rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase" style="color: green">Login</h2>
                            <p class="text-black-5 mb-10" id="required_user">Please enter your login and password!</p>
                            <form action="{{ route('check_user') }}" method="post">
                                @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                @endif
                                @csrf
                                <div class="form-outline form-black mb-4">
                                    <label id="required_user" class="form-label" for="typeEmailX">Email</label>
                                    <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                        value="{{ old('email') }}" name="email">
                                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                </div>

                                <div class="form-outline form-black mb-4">
                                    <label id="required_user" class="form-label" for="typePasswordX">Password</label>
                                    <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                        value="{{ old('password') }}" name="password">
                                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                </div>

                                <p><a class="text-black-10" id="required_user" href="{{ route('sendEmail')}}">Forgot password?</a>
                                </p>

                                <button id="required_user" class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</section>
@endsection
