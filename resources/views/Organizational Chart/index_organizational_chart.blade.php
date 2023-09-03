@extends('dashboard.dashboard')

@section('sub-content')
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
    <a href="{{ route('organizational_chart.create') }}" class="btn btn-info btn-lg">Add Organizational Chart</a>
    <h1>Organizational Chart's Table </h1>
    <table class="table table-x1 table-striped table-dark ">
        <thead>
            <tr>
                <th scope="col">Added by:</th>
                <th scope="col">Added at:</th>
                <th scope="col">VIEW</th>
                <th scope="col">DELETE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organizations as $organizational_chart)
                <tr>
                    <td>{{ $organizational_chart->profile->name }}</td>
                    <td>{{ $organizational_chart->uploaded_at }}</td>

                    <td>
                        <a href="{{ route('organizational_chart.show', $organizational_chart) }}"
                            class="btn btn-primary">VIEW</a>
                    </td>
                    <td>
                        <form action="{{ route('organizational_chart.destroy', $organizational_chart) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this announcement?')">DELETE</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
