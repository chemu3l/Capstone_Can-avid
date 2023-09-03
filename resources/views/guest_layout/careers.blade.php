@extends('welcome')

@section('content')
    @foreach ($careers as $career)
        <div class="card" style="width: 18rem;">
            <h3>{{ $career->career_position }}</h3>
            <div class="card-body">
              <h5 class="card-title">{{ date('m-d-Y', strtotime($career->career_uploaded))}}</h5>
              <p class="card-text">{{ $career->career_description }}</p>
              <span>{{ $career->career_requirements }}</span>
              <a href="{{ route('applicants.create', ['career_id' => $career->id]) }}" class="btn btn-primary">Apply Now</a>
            </div> 
          </div>
    @endforeach
@endsection
