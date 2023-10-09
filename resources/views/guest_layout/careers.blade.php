@extends(auth()->check() ? 'dashboard.dashboard' : 'welcome')

@section('content')
    <div class="headers_text_title">
        Careers
    </div>
    <div class="menu_class">
        <div class="row">
            @foreach ($careers as $career)
                <div class="col-md-3" style="margin-left: 5%; margin-top: 10px;">
                    <div class="card mb-4" style="border-radius:5%">
                        <div class="card-body" style="background-color: #1A5D1A; border-radius:5%; color: white;">
                            <h3 class="card-title">{{ $career->career_position }}</h3>
                            <h5 class="card-subtitle mb-2 text-muted">
                                {{ date('m-d-Y', strtotime($career->career_uploaded)) }}
                            </h5>
                            <p class="card-text">{{ $career->career_description }}</p>
                            <span>{{ $career->career_requirements }}</span><br>
                            <a href="{{ route('applicants.create', ['career_id' => $career->id]) }}"
                                style="border-color: black;" class="btn btn-success">Apply
                                Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
