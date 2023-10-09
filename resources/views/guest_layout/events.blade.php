@extends(auth()->check() ? 'dashboard.dashboard' : 'welcome')

@section('content')
    <div class="event_content_container" style="margin-top: 20px;">
        <div class="header_event">
            Events
        </div>
        <div class="event-container">
            <button class="left-button" id="pnButton">&#129144;</button>
            <div class="slider">
                @foreach ($eventItems as $event)
                    <div class="slide active">
                        <h3>{{ $event->events }}</h3>
                        <h6>Started at: {{ $event->events_started }}</h6>
                        <h6>Ended at: {{ $event->events_uploaded }}</h6>
                        <p id="event_description">{{ $event->events_description }}</p>
                        <a href="{{ route('show_event', $event) }}" class="btn btn-primary"
                            style="background-color: green; width: 50%; margin-left: 25%;">Show More</a>
                    </div>
                @endforeach
            </div>
            <button class="right-button" id="pnButton">&#129146;</button>
        </div>
    </div>
    <script>
        'use strict';
        //Need to be Optimized

        const slide = document.querySelectorAll(".slide");
        const btnLeft = document.querySelector(".left-button");
        const btnRight = document.querySelector(".right-button");

        //Declaring variables
        let currentPosition = 0;
        let maxPosition = slide.length - 1;
        //functions

        const leftSlide = function() {
            if (currentPosition === 0) {
                currentPosition = maxPosition;
            } else if (currentPosition >= 1) {
                currentPosition--;
            }
            let prevSlide;
            currentPosition == 4 ? (prevSlide = 0) : (prevSlide = currentPosition + 1);

            slide.forEach((s) => s.classList.remove("prevSlide"));
            slide.forEach((s) => s.classList.remove("animatePrevSlide"));
            slide.forEach((s) => s.classList.remove("rightSlide"));
            slide.forEach((s) => s.classList.remove("leftSlide"));
            slide.forEach((s) => s.classList.remove("active"));
            slide[currentPosition].classList.add("leftSlide");
            slide[currentPosition].classList.add("active");
            slide[prevSlide].classList.add("prevSlide");
            slide[prevSlide].classList.add("animatePrevSlide");
        };
        const rightSlide = function() {
            if (currentPosition === maxPosition) {
                currentPosition = 0;
            } else {
                currentPosition++;
            }
            let prevSlide;
            currentPosition == 0 ?
                (prevSlide = maxPosition) :
                (prevSlide = currentPosition - 1);

            slide.forEach((s) => s.classList.remove("prevSlide"));
            slide.forEach((s) => s.classList.remove("animatePrevSlide"));
            slide.forEach((s) => s.classList.remove("rightSlide"));
            slide.forEach((s) => s.classList.remove("leftSlide"));
            slide.forEach((s) => s.classList.remove("active"));
            slide[currentPosition].classList.add("rightSlide");
            slide[currentPosition].classList.add("active");
            slide[prevSlide].classList.add("prevSlide");
            slide[prevSlide].classList.add("animatePrevSlide");
        };
        btnLeft.addEventListener("click", leftSlide);
        btnRight.addEventListener("click", rightSlide);
    </script>
@endsection
