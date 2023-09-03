@extends('dashboard.dashboard')

@section('sub-content')
<a href="{{ route('careers.index') }}" class="btn btn-info btn-lg">Go Back</a><br>
    <div class="row">
        <div class="col-sm-8">
            <h4>{{ $career->id }}</h4>
            <h1>{{ $career->career_position }}</h1>
            <p> {{ $career->career_description }}</p>
            <p> {{ $career->career_requirements  }}</p>
            <p> {{ $career->career_uploaded }}</p>
            <p> {{ $career->profile->name }}</p>
        </div>
      </div>
@endsection
