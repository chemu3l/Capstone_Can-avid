@extends('welcome')

@section('content')
    <div class="headers_text_title">
        News
        <h3>{{ $news->news }}</h3>
    </div>
    <div class="menu_class">
        <div class="menu-event">
            <div class="sub-menu-event">
                <p>News Description: <span style="color: black; font-weight:900">{{ $news->news_description }}</span></p>
                <p>News Updated: <span style="color: black; font-weight:900">{{ $news->news_updated }}</span></p>
            </div>
        </div>
    </div>
@endsection
