@extends('layouts.header')
@section('title','View Profile')

@section('content')
<div class="row clearfix row-deck">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center">              
               <span style="font-size:18px; font-weight:bold;">
               {{$student->userTypes->type}}
               </span>
            </div>
            <div class="card-body">
                <div id="clientPhoto" class="text-center">
                    <img src="{{asset('')}}{{$student->students->photo}}" class="img-fluid" alt="User Image">
                </div>
                <h4 class="text-center mt-2">
                {{$student->students->firstName.' '.$student->students->lastName}}
                    
                </h4>
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active" id="personalInfo" data-toggle="pill" href="#tab-personalInfo" role="tab"
                        aria-controls="tab-personalInfo" aria-selected="true">Personal Information</a>
                    <a class="nav-link" id="companyInfo" data-toggle="pill" href="#tab-companyInfo" role="tab"
                        aria-controls="tab-companyInfo" aria-selected="false">Documents</a>
                    <a class="nav-link" id="financialInfo" data-toggle="pill" href="#tab-financialInfo" role="tab"
                        aria-controls="tab-financialInfo" aria-selected="false">Financial</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 tab-content" id="vert-tabs-tabContent">
        <!-- Personal Information card start -->
        <div class="card tab-pane text-left fade show active" id="tab-personalInfo" role="tabpanel"
            aria-labelledby="personalInfo">
            <div class="card-header">
                {{'Personal Details'}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0">
                        <tbody>
                            <tr>
                                <td style="width:30%;">First Name</td>
                                <td>{{$student->students->firstName}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Last Name</td>
                                <td>{{$student->students->lastName}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Fathers Name</td>
                                <td>{{$student->students->fathersName}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Mothers Name</td>
                                <td>{{$student->students->mothersName}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Gender</td>
                                <td>{{$student->students->gender}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Birth Date</td>
                                <td>{{$student->students->dob}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Contact No</td>
                                <td>{{$student->students->phone}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Gurdian Phone</td>
                                <td>{{$student->students->gurdianPhone}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Country</td>
                                <td>{{$student->students->country}}
                                </td>
                            </tr>                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Personal Information card end -->

        <!-- Company Information card start -->
        <div class="card tab-pane text-left fade" id="tab-companyInfo" role="tabpanel" aria-labelledby="companyInfo">
            <div class="card-header">
                {{'Documents'}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0">
                        <tbody>
                            <tr>
                                <td style="width:30%;">Document-1</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Document-2</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Document-3</td>
                                <td> </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Company Information card end -->

        <!-- Financial Information card start -->
        <div class="card tab-pane text-left fade" id="tab-financialInfo" role="tabpanel"
            aria-labelledby="financialInfo">
            <div class="card-header">
                {{'Financial Information'}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0">
                        <tbody>
                            
                            <tr>
                                <td style="width:30%;">Account Holder Name</td>
                                <td>{{$student->financials->accHolderName}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Account No</td>
                                <td>{{$student->financials->accNumber}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Bank Name</td>
                                <td>{{$student->financials->accNumber}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Branch Name</td>
                                <td>{{$student->financials->accNumber}}</td>
                            </tr>
                            <tr>
                                <td style="width:30%;">Branch Code</td>
                                <td>{{$student->financials->accNumber}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Financial Information card end -->
</div>
@endsection