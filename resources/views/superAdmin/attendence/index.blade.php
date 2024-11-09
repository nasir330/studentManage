@extends('layouts.header')
@section('title', 'Student List')

@section('content')
<style>
    /* Remove bullets from list items */
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Optional: Add some spacing for list items if needed */
    ul li {
        margin-bottom: 5px;
    }
</style>
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
            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table table-hover table-striped text-nowrap mb-1">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Submitted by</th>
                                <th>Date</th>
                                <th colspan="2">Files</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendence as $key => $report)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $report->toUsers->employees->firstName }} {{$report->toUsers->employees->lastName}}</td>
                                <td>{{ \Carbon\Carbon::parse($report->created_at)->toDayDateTimeString() }}</td>

                                <td>
                                    @php
                                    $documents = json_decode($report->documents, true);
                                    @endphp
                                    @if(is_array($documents))
                                    <ul>
                                        @foreach ($documents as $document)
                                        <li>{{ basename($document) }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </td>
                                <td>
                                    @if(is_array($documents))
                                    <ul>
                                        @foreach ($documents as $document)
                                        <li>
                                            <a href="{{ asset($document) }}" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="{{ route('admin.delete.report', ['id' => $report->id, 'document' => $document]) }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <span>{{$attendence->links()}}</span>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- sales overview end -->
@endsection