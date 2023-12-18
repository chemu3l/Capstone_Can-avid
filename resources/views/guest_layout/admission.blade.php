@extends('welcome')
@section('content')
    <div class="headers_text_title", style="font-size: 50px;">
        ADMISSION
    </div>
    <div class="box-container">
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center"
                    style="background-color: white;">
                    <div class="inner color-white">
                        <h3 class="flip-box-header" style="color: green;">Step 1:</h3>
                        <p id="enrollment-p" style="color: black;" >First step of enrollment through online is downloading the enrollment form</p>
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                    </div>
                </div>

                <div class="flip-box-back text-center"
                    style="background-color:black;">
                    <div class="inner color-white">
                        <h3 class="flip-box-header", style="color: green;">Click Download Now</h3>
                        <p id="enrollment-p", style="color: white;">Download the form, print and fill up required informations.</p>
                        <a href="{{ asset('images/Annex-Basic-Education-Enrollment-Form.pdf') }}" download>
                            <button class="flip-box-button">Download now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center"
                    style="background-color:white;">
                    <div class="inner color-white">
                        <h3 class="flip-box-header;" style="color: green; font-weight:bold;">Step 2:</h3>
                        <p style="color:black; font-weight:bold;">Brigada Eskwela enrollment</p>
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-color:black;">
                    <div class="inner color-white">
                        <h3 class="flip-box-header" style="color: green;">Brigada Eskwela</h3>
                        <p style="color: white; font-weight:800;">Ask assistance from the school facilitator</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center filter-"
                    style="background-color:white;">
                    <div class="inner color-white">
                        <h3 class="flip-box-header" style="color: green;">Step 3:</h3>
                        <p style="color: black; font-weight: bolder;">Completion of requirements.</p>
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-color:black;">
                    <div class="inner color-white">
                        <h5 class="flip-box-header" style="color:green;">Pass the Requirements</h5>
                        <p style="color: white; font-weight: bold;">Locate your assigned teacher and submit enrollment
                            requirements</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
