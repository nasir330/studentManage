@extends('layouts.header')
@section('title','Manage Projects')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Client Manage Projects</h3>
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
                <div class="d-flex justify-content-start mb-3">
                    <form action="{{route('employee.start.work')}}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            
                            <div>
                                <label for="clientId" class="mb-0">Projects</label>
                                <div class="input-group mb-2">
                                    {{-- <input type="hidden" id="" name="clientId" value="{{$clientId->projects->clientId}}" /> --}}
                                    <select id="projectId" name="projectId" class="form-select form-control" required>
                                        <option value="">--Select Project--</option>
                                        @foreach($projects as $key=> $project)
                                        <option value="{{$project->id}}">
                                            {{$project->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive col-md-6">
                    <table class="table table-hover table-striped text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project Id</th>
                                <th>Title</th>
                                <th>Employee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tBody">
                           {{-- @foreach ($projects as $project)
                               <tr>
                                <th></th>
                                <th>{{ $project->id }}</th>
                                <th>{{ $project->title }}</th>
                                <th>@if (!empty($project->projectManage->employees->nickName))
                                    {{ $project->projectManage->employees->nickName }}
                                    @else
                                        Employee not assigned
                                @endif</th>
                                <th><i class="fa-solid fa-folder-open"></i></th>
                            </tr>
                           @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('customJs')
    <script>
        $(document).on('change', '#projectId', function () {
            var projectId = $(this).val();
            $('#tBody').empty();
            // alert(projectId);
            var projectUrl = '/client/fetch-project/' + projectId;
            $.ajax({
                url: projectUrl,
                type: 'get',
                success: function (response) {
                    console.log(response);
                    if(response["status"] == true){
                        var id = response["projectId"];
                        var title = response["title"];
                        var employee = response["nickname"];
                        if(employee == null){
                            employee = 'Employee Not Assigned';
                        }
                        var option = '<tr><th></th><th>' + id + '</th><th>' + title + '</th><th>' + employee + '</th><th><i class="fa-solid fa-folder-open"></i></th></tr>';
                        $('#tBody').append(option);
                    }
                },
                error: function(jqXHR, exception){
                    console.log('Something went wrong');
                } 
            });
        });

    </script>
@endsection