@extends('dashboard.user.admin.admin_dashboard')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/admin/table.css')}}">

<div class="container">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="create_news">Add News</button>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create News</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="news">News Title:</label>
                            <input type="text" class="form-control @error('news') is-invalid @enderror" name="news" id="news" value="{{ old('news') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="news_description">News Description:</label>
                            <input type="text" class="form-control @error('news_description') is-invalid @enderror" name="news_description" id="news_description" value="{{ old('news_description') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="news_uploaded">News Uploaded:</label>
                            <input type="date" class="form-control @error('news_uploaded') is-invalid @enderror" name="news_uploaded" id="news_uploaded" value="{{ old('news_uploaded') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="picture">Add Pictures:</label>
                            <input type="file" class="form-control-file @error('news_images') is-invalid @enderror" name="news_images" id="news_images" accept="image/*" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-block">Add News</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <h1>News Table </h1>
</div>
@endsection