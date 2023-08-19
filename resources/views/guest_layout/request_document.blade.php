@extends('welcome')

@section('content')

<div class="container">
    <form class="border border-light p-5" action="" method="POST">
        @csrf
        <p class="h4 mb-4 text-center">Request Document</p>

        <input type="text" id="" class="form-control mb-4" placeholder="Requesting Document from School">
        <input type="text" id="" class="form-control mb-4" placeholder="Student Name">
        <input type="text" id="" class="form-control mb-4" placeholder="Requester Name">
        <input type="date" id="" class="form-control mb-4" placeholder="Request Date to Get">
        <input type="email" id="" class="form-control mb-4" placeholder="Requester Email">
        <button class="btn btn-info btn-block my-4" type="submit">Request File</button>
    </form>


</div>
@endsection
