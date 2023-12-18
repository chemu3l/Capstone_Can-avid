@extends('welcome')

@section('content')

    <div class="carousel-wrap">
        <div class="headers_text_title", style="font-size: 50px;">
            Announcements
        </div>
        <div class="btn-wrap">
            <button class="prev-button" style="margin-top: 20px;" aria-label="Previous Item">Prev</button>
            <button class="next-button" aria-label="Next Item">Next</button>
        </div>
        <div class="carousel">
            @foreach ($announcements as $announcement)
                <div style="background-color:#1E7E34;">
                    <h1>{{ $announcement->announcements }}</h1>
                    <p>What: {{ $announcement->announcements_what }}</p>
                    <p>Who: {{ $announcement->announcements_who }}</p>
                    <p>When: {{ $announcement->announcements_when }}</p>
                    <p>How: {{ $announcement->announcements_how }}</p>
                    <p>Where: {{ $announcement->announcements_where }}</p>
                    <p>Why: {{ $announcement->announcements_where }}</p>
                    @if ($announcement->announcements_images)
                        @foreach (json_decode($announcement->announcements_images) as $mediaUrl)
                        {{-- @php
                            dd($mediaUrl)
                        @endphp --}}
                            @if (Str::contains($mediaUrl, ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ asset('storage/' . $mediaUrl) }}" alt="Image"
                                    style="height:50%; margin-top:10px;">
                            @else
                                <div class="video-container">
                                    <video controls>
                                        <source src="{{ asset('storage/' . $mediaUrl) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function getCurrentSlideIndex() {
            var activeSlide = document.querySelector('.carousel div.active');
            return activeSlide ? Array.from(activeSlide.parentNode.children).indexOf(activeSlide) : 0;
        }

        function setSlideWidth() {
            const carousel = document.querySelector('.carousel');
            const slides = document.querySelectorAll('.carousel div');
            const width = parseInt(getComputedStyle(document.querySelector('.carousel-wrap')).width);
            const slideMargin = parseInt(getComputedStyle(slides[getCurrentSlideIndex()]).marginLeft) + parseInt(
                getComputedStyle(slides[getCurrentSlideIndex()]).marginRight);
            slides.forEach(slide => slide.style.width = (width - slideMargin) + "px");
            carousel.style.transform =
                `translateX(${-1 * (width * getCurrentSlideIndex() + slideMargin * getCurrentSlideIndex())}px)`;
        }

        function showSlide(index) {
            const slides = document.querySelectorAll('.carousel div');
            const carousel = document.querySelector('.carousel');
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
            currentSlideIndex = index;
            const slideMargin = parseInt(getComputedStyle(slides[getCurrentSlideIndex()]).marginLeft) + parseInt(
                getComputedStyle(slides[getCurrentSlideIndex()]).marginRight);
            const slideWidth = parseInt(getComputedStyle(slides[getCurrentSlideIndex()]).width);
            carousel.style.transform = `translateX(${-1 * (slideWidth * index + slideMargin * index)}px)`;
        }

        function initSlider() {
            const slides = document.querySelectorAll('.carousel div');
            const carousel = document.querySelector('.carousel');
            const prevButton = document.querySelector('.prev-button');
            const nextButton = document.querySelector('.next-button');
            let startX, currentX;

            prevButton.addEventListener('click', showPreviousSlide);
            nextButton.addEventListener('click', showNextSlide);
            document.addEventListener('keydown', handleKeyDown);
            carousel.addEventListener('mousedown', handleDragStart);
            carousel.addEventListener('mousemove', handleDragOngoing);
            carousel.addEventListener('mouseup', handleDragEnd);
            carousel.addEventListener('touchstart', handleDragStart);
            carousel.addEventListener('touchmove', handleDragOngoing);
            carousel.addEventListener('touchend', handleDragEnd);
            carousel.addEventListener('touchcancel', handleDragEnd);

            function showPreviousSlide() {
                showSlide((getCurrentSlideIndex() - 1 + slides.length) % slides.length);
            }

            function showNextSlide() {
                showSlide((getCurrentSlideIndex() + 1) % slides.length);
            }

            function handleKeyDown(event) {
                if (event.key === 'ArrowRight') {
                    showNextSlide();
                } else if (event.key === 'ArrowLeft') {
                    showPreviousSlide();
                }
            }

            function handleDragStart(event) {
                event.preventDefault();
                startX = (event.type === 'touchstart') ? event.touches[0].clientX : event.clientX;
            }

            function handleDragOngoing(event) {
                event.preventDefault();
                if (!startX) return;
                currentX = (event.type === 'touchmove') ? event.touches[0].clientX : event.clientX;
                const distanceX = currentX - startX;
                carousel.style.transform = `translateX(${(event.clientX * (1 / slides.length) * -1)}px)`;
            }

            function handleDragEnd(event) {
                event.preventDefault();
                if (!startX) return;
                currentX = event.clientX;
                if (currentX > startX) {
                    showPreviousSlide();
                } else if (currentX < startX) {
                    showNextSlide();
                }
                startX = currentX = null;
            }

            slides.forEach(slide => {
                slide.addEventListener('mousedown', handleDragStart);
                slide.addEventListener('mousemove', handleDragOngoing);
                slide.addEventListener('mouseup', handleDragEnd);
                slide.addEventListener('touchstart', handleDragStart);
                slide.addEventListener('touchmove', handleDragOngoing);
                slide.addEventListener('touchend', handleDragEnd);
                slide.addEventListener('touchcancel', handleDragEnd);
            });

            showSlide(0);
            setSlideWidth();

            document.querySelector('.carousel-wrap').style.visibility = "visible";
        }

        document.addEventListener('DOMContentLoaded', function() {
            initSlider();
        });

        window.addEventListener('resize', setSlideWidth);
    </script>
@endsection
