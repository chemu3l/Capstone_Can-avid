@extends('welcome')

@section('content')
    <section class="vh-100 gradient-custom" id="loginDIV">
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
        <div class="container py-2 h-100">
            <div class="row d-flex justify-content-center align-items-center h-10">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: .5rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase" style="color: #A4FF90">Login</h2>
                                <p class="text-black-5 mb-10" id="required_user">Please enter your login and password!</p>
                                <form action="{{ route('check_user') }}" method="post" id="form-login">
                                    @if (Session::get('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                    @csrf
                                    <div class="form-outline form-black mb-4">
                                        <label id="required_user" class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                            value="{{ old('email') }}" name="email">
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-outline form-black mb-4">
                                        <label id="required_user" class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                            value="{{ old('password') }}" name="password">
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <p><a class="text-black-10" id="required_user" href="{{ route('sendEmail') }}">Forgot
                                            password?</a>
                                    </p>

                                    <button id="required_user" class="btn btn-outline-light btn-lg px-5"
                                        type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const screenWidth = window.innerWidth;

                // Check if the screen width is less than 1000 pixels
                if (screenWidth < 1000) {
                    alert("You should try to use other gadgets like a laptop or desktop.");
                    window.location.href = '{{ route('HomePage') }}';
                } else {
                    const loginForm = document.getElementById('form-login');
                    loginForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission

                        // You can perform any additional validation here if needed

                        // Redirect to the Administration Page
                        window.location.href = '{{ route('sidenav') }}';
                    });
                }
            });
        </script> --}}
    </section>
    <script>
        function checkScreenWidth() {
            var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            if (screenWidth < 1300) {
                window.location.href = "/"; // Replace "/" with the actual URL of your landing page
            }
        }

        // Initial check on page load
        checkScreenWidth();

        // Check on window resize
        window.addEventListener('resize', checkScreenWidth);
    </script>
@endsection
