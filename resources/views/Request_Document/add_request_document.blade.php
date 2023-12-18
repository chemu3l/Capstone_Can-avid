@extends('welcome')

@section('content')
    <div class="headers_text_request", style="font-size: 50px;">
        Request Document
    </div>
    <div class="menu_class">
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
        <div class="request_form">
            <form class="form_for_request" action="{{ route('requests.store') }}" method="POST">
                @csrf
                {{-- <p class="h4 mb-4 text-center">Request Document</p> --}}
                {{-- <input type="text" name="Document" class="form-control mb-4" placeholder="Requesting Document from School"
                    required> --}}
                    <div class="form-group">
                        <label for="document_type">Select Document Type:</label>
                        <select name="document_type" class="form-control">
                            <option value="form_137">Form 137</option>
                            <option value="good_moral">Good Moral Certificate</option>
                            <option value="transcript">Certificate of Enrollment</option>
                            <!-- Add more options as needed for other documents -->
                        </select>
                    </div>
                <input type="text" name="Student_Name" class="form-control mb-4" placeholder="Student Name" required>
                <input type="text" name="Requester_Name" id="" class="form-control mb-4"
                    placeholder="Requester Name" required>
                {{-- <label for="Date_to_Get" class="custom-placeholder">Date to get:</label> --}}
                {{-- <input type="date" name="Date_to_Get" class="form-control mb-4" placeholder="Request Date to Get"
                    required> --}}
                <input type="email" name="Requester_Email" class="form-control mb-4" placeholder="Requester Email"
                    required>
                <br>
                <input type="submit" value="Send Request"
                    style="width: 40%; height: 40px; background-color: #004225; color: white;" />
            </form>
        </div>
    </div>
@endsection
