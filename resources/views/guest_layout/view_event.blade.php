@extends(auth()->check() ? 'dashboard.dashboard' : 'welcome')

@section('content')
    <div class="heading white-heading" id="headers_text">
        Event
        <h1>{{ $event->events }}</h1>
    </div>
    <div class="menu-event">
        <div class="sub-menu-event">
            <h4 id="descriptions-event">{{ $event->events_description }}</h4>
            <p> Started: {{ $event->events_started }}</p>
            <p> Ended: {{ $event->events_end }}</p>
        </div>
    </div>
    <div id="slideshow">
        <p class="slideshow-title">Images and Video</p>
        <div class="entire-content">
            <div class="content-carousel">
                @if ($event->events_images)
                    @foreach (json_decode($event->events_images) as $mediaUrl)
                        <figure class="shadow">
                            @if (Str::contains($mediaUrl, ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ asset('storage/' . $mediaUrl) }}" alt="Image">
                            @else
                                <video controls>
                                    <source src="{{ asset('storage/' . $mediaUrl) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </figure>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Modals -->
        <div class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img0">
            <div class="caption"></div>
        </div>

        <div class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img1">
            <div class="caption"></div>
        </div>

        <div class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img2">
            <div class="caption"></div>
        </div>

        <div class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img3">
            <div class="caption"></div>
        </div>
        <!-- Just keep duplicating modal div and change the image id you can have more images in your carousel -->
    </div>



    <script>
        var modals = document.getElementsByClassName("modal");

        for (let i = 0; i < modals.length; i++) {
            let modal = modals[i];

            let img = document.getElementsByClassName("content-carousel")[0].getElementsByTagName("img")[i];
            let modalImg = document.getElementById("img" + i);
            let captionText = document.getElementsByClassName("caption")[i];

            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                modalImg.alt = this.alt;
                captionText.innerHTML = this.alt;
            }

            let span = document.getElementsByClassName("close")[i];

            span.onclick = function() {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
