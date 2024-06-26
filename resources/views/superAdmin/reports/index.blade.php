@extends('layouts.header')
@section('title','Activity Logs')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Reports</h3>
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
                                <th>Employee Id</th>
                                <th>Employee Name</th>
                                <th>Activity</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach($activityLog as $key => $logs)                               
                                <tr>
                                    <td>{{$key + 1}}</td>                                   
                                    <td>{{$logs->userId}}</td>                                   
                                    <td>{{$logs->employees->firstName}} {{$logs->employees->lastName}}</td>                                   
                                    <td>{{$logs->activity}}</td>                                   
                                    <td>{{ $logs->created_at->format('d-m-y H:i:s') }}                                
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
<!-- @include('templates.modal.workBreak') -->
@endsection

@section('customJs')
<script>


</script>
@endsection