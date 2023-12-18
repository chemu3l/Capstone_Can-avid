@extends('home')

@section('sub-content')
    <div class="tables-administer">
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


        <div class="header-tables-page">
            <a href="{{ route('organizational_chart.create') }}" class="btn btn-info btn-lg"
                style="background-color: green; margin-bottom:3%">Add Organizational Chart</a>
            <h1 style="margin-right: 500px;">Organizational Chart's Table </h1>
        </div>
        <table style="background-color: #A8DF8E; font-size: 12px; width: 100%; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th scope="col" style="padding:10px;">Added by:</th>
                    <th scope="col" style="padding:10px;">Added at:</th>
                    <th scope="col" style="padding:10px;">View</th>
                    <th scope="col" style="padding:10px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizations as $organizational_chart)
                    <tr>
                        <td style="padding:10px;">{{ $organizational_chart->profile->name }}</td>
                        <td style="padding:10px;">{{ $organizational_chart->uploaded_at }}</td>

                        <td style="padding:10px;">
                            <a href="{{ route('organizational_chart.show', $organizational_chart) }}"
                                class="btn btn-primary" style="background-color: green">VIEW</a>
                        </td>
                        <td style="padding:10px;">
                            <form action="{{ route('organizational_chart.destroy', $organizational_chart) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this Organizational Chart?')">DELETE</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
