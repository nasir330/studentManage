@extends('layouts.header')
@section('title', 'Student List By Country')

@section('content')

<!-- sales overview start -->
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-3 d-flex justify-content-start">
                    <h3 class="card-title">Students List</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    @if (session()->has('delete'))
                    <div id="deleteMessage" class="alert-danger">
                        <span style="color:red;">{{ session('delete') }}</span>
                    </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <form action="{{route('admin.student.search.country')}}" method="POST">
                        @csrf
                        <div class="input-group p-0">
                            <div class="input-group-text p-0 mx-0">
                                <a href="{{route('admin.student.list')}}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                            <select name="country" class="form-select form-control" required>
                                <option value="" disabled selected>Countries</option>
                                @foreach ($countries as $key => $country)
                                <option value="{{ $country->id }}">
                                    {{ $country->countryName }}
                                </option>
                                @endforeach
                            </select>
                            <div class="input-group-text p-0 mx-0">
                                <button class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table table-hover table-striped text-nowrap mb-1">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <!-- <th>Department</th>
                                    <th>Designation</th>
                                    <th>Shift</th>
                                    <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countryStudents as $key => $students)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $students->firstName . ' ' . $students->lastName }}</td>
                                <td>{{ $students->toUsers->email }}</td>
                                <td>{{ $students->countryList->countryName }}</td>

                                <td>
                                    <div class="card-options d-flex justify-content-start">
                                        <div class="dropend">
                                            <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <a href="{{ route('admin.view.student', ['id' => $students->userId]) }}">
                                                        <i class="dropdown-icon fa fa-eye"></i>
                                                        View Details
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{ route('admin.edit.student', ['id' => $students->userId]) }}">
                                                        <i class="dropdown-icon fa fa-edit"></i>
                                                        edit
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a
                                                        href="{{ route('admin.delete.employee', ['id' => $students->userId]) }}">
                                                        <i class="dropdown-icon fa fa-trash"></i>
                                                        Delete
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span>{{$countryStudents->links()}}</span>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- sales overview end -->
@endsection