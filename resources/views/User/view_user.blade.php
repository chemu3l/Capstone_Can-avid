@extends('dashboard.dashboard')

@section('sub-content')
<a href="{{ route('users.index') }}" class="btn btn-info btn-lg">Go Back</a>
<div class="row">
    <div class="col-sm-8">
        <h4>{{ $user->id }}</h4>
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
@endsection
