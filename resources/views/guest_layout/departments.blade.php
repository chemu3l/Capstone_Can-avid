@extends('welcome')

@section('content')

    <div class="headers_text_title">
        Department
    </div>
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
    <div class="menu_class">
        <div class="menu-department">
            <div class="sub-menu-department">
                <form method="POST" action="{{ route('departments.filter') }}">
                    @csrf
                    <select name="department" id="department-input">
                        <option value="">Select Department</option>
                        <option value="Mathematics" {{ old('department') === 'Mathematics' ? 'selected' : '' }}>Mathematics
                            Department
                        </option>
                        <option value="Science" {{ old('department') === 'Science' ? 'selected' : '' }}>Science Department
                        </option>
                        <option value="English" {{ old('department') === 'English' ? 'selected' : '' }}>English Department
                        </option>
                        <option value="Filipino" {{ old('department') === 'Filipino' ? 'selected' : '' }}>Filipino
                            Department
                        </option>
                        <option value="EdukPanlipunan" {{ old('department') === 'EdukPanlipunan' ? 'selected' : '' }}>E.S.P
                            &
                            Araling
                            Panlipunan Department</option>
                        <option value="Tle" {{ old('department') === 'Tle' ? 'selected' : '' }}>TLE Department</option>
                        <option value="Mapeh" {{ old('department') === 'Mapeh' ? 'selected' : '' }}>Mapeh Department
                        </option>
                        <option value="SHS" {{ old('department') === 'SHS' ? 'selected' : '' }}>Senior High School
                            Department
                        </option>
                        <option value="ALS" {{ old('department') === 'ALS' ? 'selected' : '' }}>Alternative Learning
                            System
                            Department</option>
                        <option value="Non-teaching" {{ old('department') === 'Non-teaching' ? 'selected' : '' }}>
                            Non-Teaching
                            Department</option>
                    </select>
                    <button id="filter-department" type="submit">Filter</button>
                </form>
            </div>
        </div>
        @if (isset($filteredData))
            @if ($department === 'EdukPanlipunan')
                <h3 id="h3SelectedDepartment">E.S.P & Araling Panlipunan Department</h3>
            @else
                <h3 id="h3SelectedDepartment">{{ $department }} Department</h3>
            @endif
            <div class="row">
                @foreach ($filteredData as $data)
                    <div class="col-md-2">
                        <div class="circle">
                            @if ($data->images)
                                <img src="{{ asset('storage/' . $data->images) }}" alt="Image" class="circle-img">
                                <p class="name">{{ $data->name }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
