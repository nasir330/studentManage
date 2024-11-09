@extends('layouts.header')
@section('title', 'Add Students')

@section('content')

<!-- sales overview start -->
<div class="row clearfix row-deck">
    <div class="col mb-2">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title">Add New Student</h3>
                @if (session()->has('success'))
                <div id="successMessage" class="text-center text-success p-2 ml-3">
                    <span style="color:green;">{{ session('success') }}</span>
                </div>
                @endif
            </div>
            <div class="card-body p-2">
                <form action="{{ route('employee.add.student') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div id="boxitem" class="row">
                        <!-- Personal and Auth Information start -->
                        <div class="col-md-6">
                            <!-- Personal info start -->
                            <div class="card">
                                <div class="card-header">
                                    Student's Information
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="firstName" class="mb-0">First Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="firstName" class="form-control"
                                                    placeholder="Enter first name" required>
                                                <input type="hidden" name="userType" value="{{$userTypes->id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="mb-0">Last Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="lastName" class="form-control"
                                                    placeholder="Enter last name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="fathersName" class="mb-0">Fathers
                                                Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="fathersName" class="form-control"
                                                    placeholder="Enter fathers name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mothersName" class="mb-0">Mothers Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="mothersName" class="form-control"
                                                    placeholder="Enter mothers name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="gender" class="mb-0">Gender</label>
                                            <div class="input-group mb-2">
                                                <select name="gender" class="form-select form-control" required>
                                                    <option value="">--Select Gender--</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="dob" class="mb-0">Date of Birth</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="dob" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="mb-0">Phone</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="Phone number" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="email" class="mb-0">Email</label>
                                            <div class="input-group mb-2">
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Enter email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gurdianPhone" class="mb-0">Gurdian's Phone</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="gurdianPhone" class="form-control"
                                                    placeholder="Gurdian's Phone" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="country" class="mb-0">Prefered Country</label>
                                            <div class="input-group mb-2">
                                                <select name="country" class="form-select form-control" required>
                                                    <option value="">--Select Country--</option>
                                                    @foreach ($countries as $key => $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->countryName }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="councilorComments" class="mb-0">Counselor Comments</label>
                                            <div class="input-group mb-2">
                                                <textarea name="councilorComments" rows="3"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="managerComment" class="mb-0">Manager's Comments</label>
                                            <div class="input-group mb-2">
                                                <textarea name="managerComment" rows="3"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <label for="photo" class="mb-0">Photo</label>
                                            <div class="input-group mb-2">
                                                <input type="file" name="photo" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <label for="docs" class="mb-0">Documents</label>
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
                            <!-- Personal info end -->

                            <!-- Auth info start -->
                            <div class="card">
                                <div class="card-header">
                                    Academic Qualifications
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="academicQualification" class="mb-0">Write down into the
                                                box..</label>
                                            <div class="input-group mb-2">
                                                <textarea name="academicQualification" rows="3"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="epGroup" class="mb-0"> English Profiency</label>
                                            <div class="input-group mb-2">
                                                <select id="epGroup" name="epGroup" class="form-select form-control"
                                                    required>
                                                    <option value="">--Select Item--</option>
                                                    <option value="IELTS">IELTS</option>
                                                    <option value="PTE">PTE</option>
                                                    <option value="PTE">OIETC</option>
                                                    <option value="PTE">DUOLINGO</option>
                                                    <option value="PTE">MOI</option>
                                                    <option value="PTE">PSI</option>
                                                    <option value="PTE">OTHERS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="epScore" class="mb-0">Score</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="epScore" class="form-control"
                                                    placeholder="Enter Score">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="workExperience" class="mb-0">Work Experience</label>
                                            <div class="input-group mb-2">
                                                <textarea name="workExperience" rows="3"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Auth info end -->
                        </div>
                        <!-- Personal and Auth Information end -->


                        <div class="col-md-6">
                            <!-- Company info start -->

                            <!-- Company info end -->

                            <!-- Financial info start -->
                            <div class="card">
                                <div class="card-header">
                                    Payments
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="paymentMethods" class="mb-0">Payment Methods</label>
                                            <div class="input-group mb-2">
                                                <select name="paymentMethods" class="form-select form-control" required>
                                                    <option value="">--Select Methods--</option>
                                                    <option value="Bank">Bank</option>
                                                    <option value="VISA/MASTER CARD">VISA/MASTER CARD</option>
                                                    <option value="Cash">Cash</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="payAmount" class="mb-0">Amount</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="payAmount" class="form-control"
                                                    placeholder="Enter Amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="paymentDescription" class="mb-0">Description</label>
                                            <div class="input-group mb-2">
                                                <textarea name="paymentDescription" rows="3"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="leadSource" class="mb-0">Lead Source</label>
                                            <div class="input-group mb-2">
                                                <select name="leadSource" class="form-select form-control" required>
                                                    <option value="">--Select--</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Online">Online</option>
                                                    <option value="Walking">Walking</option>
                                                    <option value="Reference">Reference</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="accHolderName" class="mb-0">Account Holder
                                                Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="accHolderName" class="form-control"
                                                    placeholder="Account Holder Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="accNumber" class="mb-0">Account
                                                Number</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="accNumber" class="form-control"
                                                    placeholder="Account Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="bankName" class="mb-0">Bank Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="bankName" class="form-control"
                                                    placeholder="Bank Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="branch" class="mb-0">Branch Name</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="branch" class="form-control"
                                                    placeholder="Branch Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="branchCode" class="mb-0">Branch Code</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="branchCode" class="form-control"
                                                    placeholder="Branch Code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="joinDate" class="mb-0">Join Date</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="joinDate" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="leavingDate" class="mb-0">Leaving Date</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="leavingDate" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Financial info end -->
                            <!-- Others Information start -->
                            <div class="card">
                                <div class="card-header">
                                    Other's
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="currentDate" class="mb-0">Current Date</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="currentDate" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="remindDate" class="mb-0">Reminder Date</label>
                                            <div class="input-group mb-2">
                                                <input type="date" name="remindDate" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="followupFor" class="mb-0">Follow up for</label>
                                            <div class="input-group mb-2">
                                                <textarea name="followupFor" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <label for="assignedTo" class="mb-0">Assigned to</label>
                                            <div class="input-group mb-2">
                                                <select name="assignedTo" class="form-select form-control" required>                                                    
                                                    <option value="{{Auth::user()->id}}" selected>
                                                        {{Auth::user()->employees->firstName}} {{Auth::user()->employees->lastName}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status" class="mb-0">Status</label>
                                            <div class="input-group mb-2">
                                                <select name="status" class="form-select form-control" required>
                                                    <option value="">--Status--</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="weightage" class="mb-0">Weightage</label>
                                            <div class="input-group mb-2">
                                                <select name="weightage" class="form-select form-control" required>
                                                    <option value="">--Select--</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Bad">Bad</option>
                                                    <option value="Cold">Cold</option>
                                                    <option value="Dead">Dead</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Others Information end -->
                        </div>

                    </div>

                    <div class="row mb-2 float-end">
                        <div class="input-group">
                            <button class="btn btn-primary">
                                Submit
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