@extends('welcome')
@section('content')
    <div class="headers_text_title">
        Admission
    </div>
    <div class="box-container">
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center"
                    style="background-image: url('images/CNHS_IMAGE/images/294580961_803577974356201_7493459147231995051_n.jpg');">
                    <div class="inner color-white">
                        <h3 class="flip-box-header">First step:</h3>
                        <p id="enrollment-p">First step of enrollment through online is downloading the enrollment form</p>
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-image: url('images/CNHS_IMAGE/images/300997012_822173012496697_5135393954092313543_n.jpg');">
                    <div class="inner color-white">
                        <h3 class="flip-box-header">Click Download now</h3>
                        <p id="enrollment-p">Download the form, print and fill up required informations.</p>
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
                    style="background-image: url('images/CNHS_IMAGE/images/298726998_815431956504136_7846094969080861901_n.jpg');">
                    <div class="inner color-white">
                        <h3 class="flip-box-header">Second step:</h3>
                        <p style="color:black;">Brigada Eskwela enrollment</p>
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-image: url('images/CNHS_IMAGE/images/298912821_815431816504150_1337006039631665656_n.jpg');">
                    <div class="inner color-white">
                        <h3 class="flip-box-header">Brigada Eskwela</h3>
                        <p style="color: white; font-weight:500;">Ask assistance from the school facilitator</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center filter-"
                    style="background-image: url('images/CNHS_IMAGE/images/295965473_804555530925112_7338399960670034814_n.jpg');">
                    <div class="inner color-white">
                        <h3 class="flip-box-header">Third step:</h3>
                        <p style="color: black; font-weight: bolder;">Completion of requirements.</p>
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-image: url('images/CNHS_IMAGE/images/295854349_804555394258459_3111571413169100459_n.jpg');">
                    <div class="inner color-white">
                        <h5 class="flip-box-header">Pass the Requirements</h5>
                        <p style="color: #004225; font-weight: bold;">Locate your assigned teacher and submit enrollment
                            requirements</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
