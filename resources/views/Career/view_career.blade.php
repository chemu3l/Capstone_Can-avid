@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('careers.index') }}" class="btn btn-info btn-lg" style="background-color: green; margin-bottom:3%">Go
            Back</a>
        <div class="row">
            <div class="col-sm-8">
                <h1>{{ $career->career_position }}</h1>
                <p> {{ $career->career_description }}</p>
                <p> {{ $career->career_requirements }}</p>
                <p> {{ $career->career_uploaded }}</p>
                <p> {{ $career->profile->name }}</p>
            </div>
        </div>
    </div>
@endsection
