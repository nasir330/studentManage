@extends('layouts.header')
@section('title','Manage Projects')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Manage Projects</h3>
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
                    <form action="{{route('add.project')}}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="title" class="mb-0">Project Title</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Enter Project Title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="councilorId" class="mb-0">Employee</label>
                              
                                <div class="input-group mb-2">
                                    <select name="councilorId" class="form-select form-control" required>
                                        <option value="">--Select Employee--</option>
                                        @foreach($employeeList as $key=> $employee)
                                        <option value="{{$employee->id}}">
                                            {{$employee->employees->firstName}} {{$employee->employees->lastName}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-auto">
                                <button class="btn btn-primary">Add</button>
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
                        <tbody>
                           @foreach($projects as $key=> $project)
                           <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$project->projectId}}</td>
                            <td>{{$project->title}}</td>
                            <td>{{$project->employees->firstName}} {{$project->employees->firstName}}</td>
                            <td>
                                    <div class="card-options d-flex justify-content-start">
                                        <div class="dropend">
                                            <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <a href="{{route('edit.designations',['id'=>$project->id])}}">
                                                        <i class="dropdown-icon fa fa-edit"></i>
                                                        edit
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#" onclick="deleteProject({{ $project->id }})" >
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
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('customJs')
    <script>
        function deleteProject(id){
            console.log(id);
            var url = '{{ route("project.delete","ID")}}';
            console.log(url);
            var newUrl = url.replace("ID",id);
            console.log(newUrl);
            if(confirm("Are you sure you want to delete")){
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        if(response["status"]){
                            window.location.href="{{ route('projects') }}";
                        } 
                    }
                });
            }
        }
    </script>
@endsection