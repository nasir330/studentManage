@extends('layouts.header')
@section('title', 'Daily Attendence')

@section('content')

<!-- sales overview start -->
<div class="row clearfix row-deck">
    <div class="col mb-2">
        <div class="card">
            <div class="card-header text-center">               
                @if (session()->has('success'))
                <div id="successMessage" class="text-center text-success p-2 ml-3">
                    <span style="color:green;">{{ session('success') }}</span>
                </div>
                @endif
            </div>
            <div class="card-body p-2">
                <form action="{{ route('admin.add.attendence') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div id="boxitem" class="row">                       
                        <div class="col-md-6">
                            <!-- Attendence sheet upload start -->
                            <div class="card">
                                <div class="card-header">
                                    Daily Attendence
                                </div>
                                <div class="card-body">                                   
                                  
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <label for="docs" class="mb-0">Attendence file</label>
                                            <div id="fileInputs">
                                                <div class="input-group mb-2">
                                                    <input type="file" name="docs[]" class="form-control"
                                                        onchange="addFileInput()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Attendence sheet upload end -->                          
                        </div> 
                    </div>

                    <div class="row mb-2 float-start">
                        <div class="input-group">
                            <button class="btn btn-primary">
                                Upload
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
@push('customJs')
<script>
    function addFileInput() {
        // Get the file inputs container
        const fileInputs = document.getElementById('fileInputs');

        // Create a new input group div
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';

        // Create a new file input
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'docs[]';
        fileInput.className = 'form-control';
        fileInput.onchange = addFileInput;

        // Append the new file input to the input group div
        inputGroup.appendChild(fileInput);

        // Append the input group div to the file inputs container
        fileInputs.appendChild(inputGroup);
    }
</script>