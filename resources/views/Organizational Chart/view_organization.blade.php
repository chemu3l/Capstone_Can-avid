@extends('home')

@section('sub-content')
    <div class="tables-administer">
        <a href="{{ route('organizational_chart.index') }}" class="btn btn-info btn-lg"
            style="background-color: green; margin-bottom:3%">Go Back</a>
        <div class="row">
            <div class="col-sm-8">
                <iframe height="700px" width="200%" src="{{ asset('storage/' . $path) }}"></iframe>
                <p> {{ $organizational_chart->profile->name }}</p>
                <p> {{ $organizational_chart->uploaded_at }}</p>
            </div>
        </div>
    </div>
@endsection
