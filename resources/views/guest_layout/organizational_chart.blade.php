@extends(auth()->check() ? 'dashboard.dashboard' : 'welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/GuestCSS/organizational_chart.css') }}">
    <div class="card">
        <iframe height="700px" width="200%" src="{{ asset('storage/' . $path) }}"></iframe>
    </div>
@endsection
