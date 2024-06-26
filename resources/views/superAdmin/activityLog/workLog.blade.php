@extends('layouts.header')
@section('title','Work Logs')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Work Log</h3>
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
                                <th>Client Name</th>
                                <th>Employee Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach($workLog as $key => $workProgress)
                                @php
                                    $startDateTime = new \DateTime($workProgress->start_time);
                                    $endDateTime   = new \DateTime($workProgress->end_time);
                                    $duration = $startDateTime->diff($endDateTime);
                                    $formattedDuration = $duration->format('%h hours %i minutes');
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$workProgress->projects->title}}</td>
                                    <td>{{$workProgress->clients->nickName}}</td>
                                    <td>{{$workProgress->employees->nickName}}</td>
                                    <td>{{\Carbon\Carbon::parse($workProgress->start_time)->format('H:i:s')}}</td>
                                    <td>
                                        
                                        @if ($workProgress->end_time)
                                            {{ \Carbon\Carbon::parse($workProgress->end_time)->format('H:i:s') }}
                                        @else
                                               
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if($formattedDuration)
                                            {{ $formattedDuration }}
                                        @else
                                        
                                        @endif
                                    </td>
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