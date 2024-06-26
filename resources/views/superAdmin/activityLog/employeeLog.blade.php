@extends('layouts.header')
@section('title','Work Logs')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Employee Log</h3>
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
                <!-- on-progress work table start -->
                <div class="col-md-12">
                    <table class="table table-hover table-striped text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Employee Name</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach($employeeLog as $key => $workProgress)
                                @php
                                    $startDateTime = new \DateTime($workProgress->start_time);
                                    $endDateTime   = new \DateTime($workProgress->end_time);
                                    $duration = $startDateTime->diff($endDateTime);
                                    $formattedDuration = $duration->format('%h hours %i minutes');
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$workProgress->project->title}}</td>
                                    <td>{{$workProgress->employees->nickName}}</td>
                                    <td>{{$workProgress->status}}</td>
                                    <td>{{\Carbon\Carbon::parse($workProgress->time)->format('H:i:s')}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- on-progress work table end -->

            </div>
        </div>
    </div>

</div>
@include('templates.modal.workBreak')
@endsection

@section('customJs')
<script>


</script>
@endsection