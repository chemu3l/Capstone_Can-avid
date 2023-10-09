@extends(auth()->check() ? 'dashboard.dashboard' : 'welcome')

@section('content')
    <div class="home-image">
        <img src="{{ asset('images/CNHS_IMAGE/IMG_3241.JPG') }}" alt="Images">
    </div>
    <!-- About Section -->
    <div class="about-us" id="about">
        <h3 class="about-us-header">About Us</h3>
        <p style="text-align: center;">
            THE LAURELS OF CAN-AVID NATIONAL HIGH SCHOOL FROM YEARS OF HARDWORK:
            TOP PERFORMING SCHOOL WITH A HEART
            (OUTSTANDING SENIOR HIGH SCHOOL IMPLEMENTER AND SBM LEVEL III)
        </p>
        <br>
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">What set<br>
            <h3>Can-avid National High School<br>
                <h3>apart as the best?
                    <p>
                        <span>Can-avid National High School</span> has earned the distinction of being a top-performing
                        school with a heart. Through relentless dedication&nbsp;and commitment to its mission, the school has achieved the
                        remarkable status of being recognized as an Outstanding Senior High School Implementer and attaining SBM Level III accreditation.
                        <br><br>
                        Since its establishment in 2002, the school has encountered numerous challenges, including enrollment
                        issues, low literacy and numeracy rates, and other academic concerns. However, under the exemplary
                        leadership of School Principal IV, <span>Ma’am Rosanna G. Catuday</span>, Can-avid National High
                        School has emerged as a shining example in the Division of Eastern Samar.
                        <br><br>
                        Central to <span>Ma’am Rosanna's</span> vision was the idea that CNHS should not just be a
                        school but a home for its learners. This home was built on a foundation of love and tranquility, offering a secure and
                        nurturing environment for students to thrive. The dedicated teachers at CNHS acted as mentors and
                        caregivers, ensuring that every student felt valued and supported, even in times of difficulty.
                        <br><br>
                        This vision resonated strongly with the Can-avid community, including parents and stakeholders, who placed
                        their trust in the school. Trust, in this context, meant not only an increase in enrollment but also a
                        comprehensive transformation of the institution.
                        <br><br>
                        To achieve these remarkable milestones, CNHS undertook significant measures, such as revitalizing its instructional methods, implementing various sub-projects to address literacy and numeracy
                        challenges, and establishing strong partnerships with the local community. The shared vision of Can-avidnons,
                        based on mutual trust and respect, served as the driving force behind these endeavors.
                        <br><br>
                        The key takeaway from this success story is the importance of performing with a heart. CNHS's educators
                        understood that the legacy they left behind was not just tangible accomplishments but also the intangible
                        impact they had on the lives of their students. The education provided at CNHS aimed to instill noble
                        aspirations and a deep sense of commitment in its learners.
                        <br><br>
                        Can-avid National High School's journey to becoming an SBM Level III institution and the Most Outstanding Senior High School Implementer was a testament to their unwavering dedication and the values of
                        <span>FAITH, LOVE, RESPECT, and TRUST</span>. Their achievements were dedicated not to personal glory but to the greater  good, as they continued to serve their community with a heart full of care.
                    </p>
    </div>
    <div class="role-container">
        <div class="mission">
            <h2>MISSION</h2>
            <p>To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete
                basic education where:<br>
                Students learn in a child-friendly, gender-sensitive, safe, and motivating environment. Teachers
                facilitate learning and constantly
                nurture every learner. Administrators and staff, as stewards of the institution, ensure an enabling and
                supportive environment
                for effective learning to happen. Family, community, and other stakeholders are actively engaged and
                share responsibility for developing
                life-long learners.</p>
        </div>
        <div class="values">
            <h2>CORE VALUES</h2>
            <p>Maka-Diyos</p>
            <p>Maka-tao</p>
            <p>Makakalikasan</p>
            <p>Makabansa</p>
        </div>
        <div class="vision">
            <h2>VISION</h2>
            <p>We dream of Filipinos who passionately love their country and whose values and competencies enable them
                to realize their full potential and contribute meaningfully to building the nation. As a
                learner-centered public institution,the Department of Education continuously improves itself to better
                serve its stakeholders.
            </p>
        </div>
    </div>
    <div class="feedback-class">
        <div class="feedback-card">
            <div class="feedback-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h3 class="feedback-header">Feedback</h3>
                <p>Fill out the form below to send us your feedback:</p>
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" type="text" id="name" placeholder="Your Name" required
                            name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" id="email" placeholder="Your Email" required
                            name="email">
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Your Message" required name="message"></textarea>
                        <p id="message-notes">Your message is highly confidential and can only be accessed by
                            authorized
                            personnel.</p>
                    </div>

                    <button type="submit" style="background-color: #004225;"  class="btn btn-primary">Send Message</button>
                </form>

            </div>
        </div>
    </div>
@endsection
