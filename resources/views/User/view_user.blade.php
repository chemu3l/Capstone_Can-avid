@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('users.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom: 3%;">Go
            Back</a>
        <div class="row">
            <div class="col-sm-8">
                <h1>{{ $user->profile->name }}</h1>
                <p> {{ $user->email }}</p>
                <p> {{ $user->profile->age }}</p>
                <p> {{ $user->profile->gender }}</p>
                <p> {{ $user->profile->position }}</p>
                <p> {{ $user->profile->department }}</p>
                <p> {{ $user->profile->phone_number }}</p>

            </div>
            <div class="col-sm-4">
                <img src="{{ asset('storage/' . $user->profile->images) }}" alt="Image"
                    style="height:100px; width:100px; border-radius:50%;">
            </div>
        </div>
    </div>
@endsection
