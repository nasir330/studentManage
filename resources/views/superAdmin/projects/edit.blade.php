@extends('layouts.header')
@section('title','Edit Designations')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-5 d-flex justify-content-start">
                    <h3 class="card-title">Edit Designations</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-start">
                    @if(session()->has('delete'))
                    <div id="deleteMessage" class="alert-danger">
                        <span style="color:red;">{{session('delete')}}</span>
                    </div>
                    @endif
                </div>

            </div>
            <div class="card-body">
                <div class="col-md-6 d-flex justify-content-start mb-3">
                    <form action="{{route('update.designations')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-2">
                                <label for="first_name">Department Name</label>
                                <div class="input-group">
                                    <strong> </strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="first_name">Designation</label>
                                <div class="input-group">
                                   
                                    <input type="text" name="designation" class="form-control"
                                        value="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-auto">
                                    <button class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('designations')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection