@extends('layouts.header')
@section('title','Work Log History')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Work Log History</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-start">
                    @if(session()->has('success'))
                    <div id="deleteMessage" class="alert-success">
                        <span style="color:green;">{{session('success')}}</span>
                    </div>
                    @endif
                    @if(session()->has('delete'))
                    <div id="deleteMessage" class="alert-danger">
                        <span style="color:red;">{{session('delete')}}</span>
                    </div>
                    @endif
                </div>

            </div>
            <div class="card-body">
                
                <!-- Work Log History table start -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Status</th>
                                <th>Time</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeeLogs as $key => $employeeLog)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{ $employeeLog->project ? $employeeLog->project->title : 'N/A' }}</td>
                                <td>{{$employeeLog->status}}</td>
                                <td>{{\Carbon\Carbon::parse($employeeLog->time)->format('H:i:s')}}</td>
                                
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Work Log History table end -->

            </div>
        </div>
    </div>

</div>
@include('templates.modal.workBreak')
@endsection