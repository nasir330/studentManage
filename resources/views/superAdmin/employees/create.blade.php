@extends('layouts.header')
@section('title', 'Create Account')

@section('content')

    <!-- sales overview start -->
    <div class="row clearfix row-deck">
        <div class="col mb-2">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Create Employees Account</h3>
                    @if (session()->has('success'))
                        <div id="successMessage" class="text-center text-success p-2 ml-3">
                            <span style="color:green;">{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('admin.add.employee') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div id="boxitem" class="row">
                            <!-- Personal and Auth Information start -->
                            <div class="col-md-6">
                                <!-- Personal info start -->
                                <div class="card">
                                    <div class="card-header">
                                        Personal Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label for="firstName" class="mb-0">First Name</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" name="firstName" class="form-control"
                                                        placeholder="Enter First Name" required>
                                                    <input type="hidden" name="userType" value="{{$userTypes->id}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="mb-0">Last Name</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" name="lastName" class="form-control"
                                                        placeholder="Enter Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <label for="gender" class="mb-0">Gender</label>
                                                <div class="input-group mb-2">
                                                    <select name="gender" class="form-select form-control" required>
                                                        <option value="">--Select Gender--</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label for="dob" class="mb-0">Date of Birth</label>
                                                <div class="input-group mb-2">
                                                    <input type="date" name="dob" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="mb-0">Phone</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" name="phone1" class="form-control"
                                                        placeholder="Primary Phone Number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-9">
                                                <label for="photo" class="mb-0">Photo</label>
                                                <div class="input-group mb-2">
                                                    <input type="file" name="photo" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Personal info end -->

                            </div>
                            <div class="col-md-6">
                                <!-- Auth info start -->
                                <div class="card">
                                    <div class="card-header">
                                        Authentication
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label for="email" class="mb-0">Email</label>
                                                <div class="input-group mb-2">
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Enter email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="mb-0">Password</label>
                                                <div class="input-group mb-2">
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Enter password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Auth info end -->
                            </div>
                            <!-- Personal and Auth Information end -->
                        </div>
                        <div class="row mb-2 float-end">
                            <div class="input-group">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- sales overview end -->
@endsection
