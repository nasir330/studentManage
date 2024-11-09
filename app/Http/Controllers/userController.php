<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employees;
use App\Models\EmployeeUpdateFields;
use App\Models\StudentsUpdateFields;
use App\Models\Student;
use App\Models\Financial;
use App\Models\UserType;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeLog;
use App\Models\ActivityLog;
use App\Models\CountryList;
use App\Exports\UsersExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Excel;

class userController extends Controller
{

   //  ########### Employee Section Star here ###########   
   public function setProfileEmployee()
   {
      $userTypes = UserType::whereNot('id', 1)->get();
      $departments = Department::all();
      $designations = Designation::all();

      return view('pages.employees.setProfile', ['userTypes' => $userTypes, 'departments' => $departments, 'designations' => $designations]);
   }
   public function setProfileDataEmployee(Request $request)
   {

      // return $request->all();
      // dd($request->all());
      // Save the user's photo
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;
      // update employee data
      Employees::where('userId', $request->profileId)->update([
         'fathersName' => $request->fathersName,
         'gender' => $request->gender,
         'dob' => $request->dob,
         'phone2' => $request->phone2,
         'referenceName' => $request->referenceName,
         'referencePhone' => $request->referencePhone,
         'govId' => $request->govId,
         'govIdNo' => $request->govIdNo,

         'address1' => $request->address1,
         'townCity1' => $request->townCity1,
         'postZipCode1' => $request->postZipCode1,
         'state1' => $request->state1,
         'country1' => $request->country1,

         'address2' => $request->address2,
         'townCity2' => $request->townCity2,
         'postZipCode2' => $request->postZipCode2,
         'state2' => $request->state2,
         'country2' => $request->country2,

         'department' => $request->department,
         'designation' => $request->designation,
         'joinDate' => $request->joinDate,
         'leaveDate' => $request->leaveDate,
         'status' => $request->status,
         'shift' => $request->shift,
         'hiringManager' => $request->hiringManager,
         'photo' => $photo_path,
      ]);

      Financial::where('userId', $request->profileId)->update([
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'bankName' => $request->bankName,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankSortCode' => $request->bankSortCode,
         'bankRoutingCode' => $request->bankRoutingCode,
         'swiftCode' => $request->swiftCode,
         'address1' => $request->address1,
         'address2' => $request->address2,
         'townCity' => $request->townCity,
         'stateProvision' => $request->stateProvision,
         'country' => $request->country,
      ]);

      // Flash a success message and redirect back
      session()->flash('success', 'Profile data updated successfully..!!');
      return redirect()->route('dashboard.employee');
   }
   public function employeeList()
   {
      $users = User::where('userType', 3)->get();
      return view('superAdmin.employees.index', ['users' => $users]);
   }
   //add employee form
   public function createEmployee()
   {
      $userTypes = UserType::where('id', 3)->first();
      return view('superAdmin.employees.create', ['userTypes' => $userTypes]);
   }
   //store employee data
   public function storeEmployee(Request $request)
   {
      //return $request->all();
      // Generate a random password
      //$autoPassword = Str::random(8);
      $autoPassword = 12345678;
      $password = "";
      if (!empty($request->password)) {
         $password = $request->password;
      } else {
         $password = $autoPassword;
      }
      // Save the user's photo
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;
      // Store document paths
      $document_paths = [];
      if ($request->hasFile('docs')) {
         foreach ($request->file('docs') as $doc) {
            $doc_name = $doc->getClientOriginalName();
            $doc_storage = $doc->storeAs("public/uploads/documents", $doc_name);
            $doc_path = 'storage/uploads/documents/' . $doc_name;
            $document_paths[] = $doc_path;
         }
      }
      // Convert document paths array to JSON
      $documents_json = json_encode($document_paths);

      // store  user data
      $user = User::create([
         'userType' => $request->userType,
         'email' => $request->email,
         'password' => Hash::make($password),
      ]);

      // store employee data
      $employee = Employees::create([
         'userId' => $user->id,
         'firstName' => $request->firstName,
         'lastName' => $request->lastName,
         'nickName' => $request->nickName,
         'fathersName' => $request->fathersName,
         'gender' => $request->gender,
         'dob' => $request->dob,
         'phone1' => $request->phone1,
         'phone2' => $request->phone2,
         'referenceName' => $request->referenceName,
         'referencePhone' => $request->referencePhone,
         'govId' => $request->govId,
         'govIdNo' => $request->govIdNo,
         'whatsappNo' => $request->whatsappNo,

         'address1' => $request->address1,
         'townCity1' => $request->townCity1,
         'postZipCode1' => $request->postZipCode1,
         'state1' => $request->state1,
         'country1' => $request->country1,

         'address2' => $request->address2,
         'townCity2' => $request->townCity2,
         'postZipCode2' => $request->postZipCode2,
         'state2' => $request->state2,
         'country2' => $request->country2,

         'department' => $request->department,
         'designation' => $request->designation,
         'joinDate' => $request->joinDate,
         'leaveDate' => $request->leaveDate,
         'status' => $request->status,
         'shift' => $request->shift,
         'hiringManager' => $request->hiringManager,
         'photo' => $photo_path,
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
      ]);


      // store financial data
      $financial = Financial::create([
         'userId' => $user->id,
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'bankName' => $request->bankName,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankSortCode' => $request->bankSortCode,
         'bankRoutingCode' => $request->bankRoutingCode,
         'swiftCode' => $request->swiftCode,
         'address1' => $request->address1,
         'address2' => $request->address2,
         'townCity' => $request->townCity,
         'stateProvision' => $request->stateProvision,
         'country' => $request->country,
      ]);

      // save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => $authEmployee->firstName . ' ' . $authEmployee->lastName . ' has created Employee id : ' . $user->id,
      ]);

      // Send the login details to the user's email
      Mail::send('notification.employeeInvitation', ['user' => $user, 'password' => $password], function ($message) use ($user) {
         $message->to($user->email)->subject('Your account has been created successfully');
      });

      // Flash a success message and redirect back
      session()->flash('success', 'Employee created successfully..!!');
      return redirect()->back();
   }
   //view employees profile
   public function viewEmployee($id)
   {
      $employee = User::find($id);
      return view('superAdmin.employees.view', ['employee' => $employee]);
   }
   //edit employees profile
   public function editEmployee($id)
   {
      $employee = User::find($id);
      $departments = Department::all();
      $designations = Designation::all();
      return view('superAdmin.employees.edit', ['employee' => $employee, 'departments' => $departments, 'designations' => $designations]);
   }
   //delete employees profile
   public function deleteEmployee($id)
   {
      User::destroy($id);
      session()->flash('delete', 'Account Deleted ..!!');
      return redirect()->back();
   }
   //employees photoUpdate
   public function photoUpdateEmployee(Request $request)
   {
      $url = "storage/";
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;

      Employees::where('userId', $request->userId)->update([
         'photo' => $photo_path,
      ]);
      // Save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => "{$authEmployee->firstName} {$authEmployee->lastName} has updated Profile Photo of employee id: {$request->id}",
      ]);
      session()->flash('success', 'Photo updated successfully..!!');
      return redirect()->back();
   }
   // Employees infoUpdate
   public function infoUpdateEmployee(Request $request)
   {
      // Fetch the current employee data from the database
      $currentEmployee = Employees::where('userId', $request->id)->first();

      // Save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => "{$authEmployee->firstName} {$authEmployee->lastName} has updated employee id: {$request->id}",
      ]);

      // List of fields to compare and update
      $fieldsToCheck = ['firstName', 'lastName', 'gender', 'dob', 'phone1'];

      // Array to hold updated fields
      $updatedFields = ['userId' => $request->id];

      // Loop through each field and compare values
      foreach ($fieldsToCheck as $field) {
         if ($currentEmployee->$field !== $request->$field) {
            $updatedFields[$field] = $request->$field;
         }
      }

      // Update the employee record if there are any changes
      if (count($updatedFields) > 1) {  // Check if there are fields other than userId
         $updateEmployees = $currentEmployee->update($updatedFields);
         if ($updateEmployees) {
            $updatedFields['logId'] = $logData->id;
            EmployeeUpdateFields::create($updatedFields);
         }
      }

      session()->flash('success', 'Employee Info updated successfully..!!');
      return redirect()->back();
   }

   //employees companyInfoUpdate
   public function companyInfoUpdateEmployee(Request $request)
   {
      Employees::where('userId', $request->id)->update([
         'department' => $request->department,
         'designation' => $request->designation,
         'joinDate' => $request->joinDate,
         'leaveDate' => $request->leaveDate,
         'status' => $request->status,
         'shift' => $request->shift,
         'hiringManager' => $request->hiringManager,
      ]);
      session()->flash('success', 'Company Info updated successfully..!!');
      return redirect()->back();
   }
   //employees financialInfoUpdate
   public function financialInfoUpdateEmployee(Request $request)
   {
      Financial::where('userId', $request->id)->update([
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankName' => $request->bankName,
         'branch' => $request->branch,
         'branchCode' => $request->branchCode,
      ]);
      session()->flash('success', 'Financial Info updated successfully..!!');
      return redirect()->back();
   }
   public function exportUser()
   {
      // return Excel::download(new UsersExport, 'users.xls');
   }

   //  ########### Student Section Star here ###########   
   //add Student form
   public function createStudent()
   {
      $userTypes = UserType::where('id', 4)->first();
      $countries = CountryList::all();
      $employees = Employees::whereNot('id', 1)->get();

      if (Auth::user()->userType == '1') {
         return view('superAdmin.students.create', [
            'userTypes' => $userTypes,
            'countries' => $countries,
            'employees' => $employees
         ]);
      } elseif (Auth::user()->userType == '3') {
         return view('employees.students.create', [
            'userTypes' => $userTypes,
            'countries' => $countries,
            'employees' => $employees
         ]);
      } else {
         return "You have no permission to access this page";
      }
   }

   //store Student data
   public function storeStudent(Request $request)
   {
      //return $request->all();
      // Generate a random password
      $autoPassword = 12341234;
      // Save the user's photo
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;

      // Store document paths
      $document_paths = [];
      if ($request->hasFile('docs')) {
         foreach ($request->file('docs') as $doc) {
            $doc_name = $doc->getClientOriginalName();
            $doc_storage = $doc->storeAs("public/uploads/documents", $doc_name);
            $doc_path = 'storage/uploads/documents/' . $doc_name;
            $document_paths[] = $doc_path;
         }
      }
      // Convert document paths array to JSON
      $documents_json = json_encode($document_paths);
      // store  user data
      $user = User::create([
         'userType' => $request->userType,
         'email' => $request->email,
         'password' => Hash::make($autoPassword),
      ]);

      $phoneNumber = $request->countryCode . $request->phone;

      // store Students data
      $student = Student::create([
         'userId' => $user->id,
         'firstName' => $request->firstName,
         'lastName' => $request->lastName,
         'fathersName' => $request->fathersName,
         'mothersName' => $request->mothersName,
         'gender' => $request->gender,
         'dob' => $request->dob,
         'phone' => $request->phone,
         'gurdianPhone' => $request->gurdianPhone,
         'country' => $request->country,
         'councilorComments' => $request->councilorComments,
         'managerComment' => $request->managerComment,
         'academicQualification' => $request->academicQualification,
         'epGroup' => $request->epGroup,
         'epScore' => $request->epScore,
         'workExperience' => $request->workExperience,
         'paymentMethods' => $request->paymentMethods,
         'payAmount' => $request->payAmount,
         'paymentDescription' => $request->paymentDescription,
         'leadSource' => $request->leadSource,
         'accHolderName' => $request->accHolderName,
         'bankName' => $request->bankName,
         'branch' => $request->branch,
         'branchCode' => $request->branchCode,
         'joinDate' => $request->joinDate,
         'leavingDate' => $request->leavingDate,
         'currentDate' => $request->currentDate,
         'remindDate' => $request->remindDate,
         'followupFor' => $request->followupFor,
         'assignedTo' => $request->assignedTo,
         'status' => $request->status,
         'weightage' => $request->weightage,
         'photo' => $photo_path,
         'documents' => $documents_json,
      ]);

      // store financial data
      $financial = Financial::create([
         'userId' => $user->id,
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'bankName' => $request->bankName,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankSortCode' => $request->bankSortCode,
         'bankRoutingCode' => $request->bankRoutingCode,
         'swiftCode' => $request->swiftCode,
         'address1' => $request->address1,
         'address2' => $request->address2,
         'townCity' => $request->townCity,
         'stateProvision' => $request->stateProvision,
         'country' => $request->country,
      ]);


      // save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => $authEmployee->firstName . ' ' . $authEmployee->lastName . ' has created Student id : ' . $user->id,
      ]);

      // Send the login details to the user's email
      // Mail::send('notification.studentInvitation', ['user' => $user, 'password' => $autoPassword], function ($message) use ($user) {
      //    $message->to($user->email)->subject('Your account has been created successfully');
      // });

      // Flash a success message and redirect back
      session()->flash('success', 'Student created successfully..!!');
      return redirect()->back();
   }

   // Student List data
   public function studentist()
   {
      $countries = CountryList::all();

      if (Auth::user()->userType == '1') {
         $studentList = Student::orderBy('id', 'asc')->paginate(10);
         return view('superAdmin.students.index', [
            'studentList' => $studentList,
            'countries' => $countries
         ]);
      } elseif (Auth::user()->userType == '3') {
         $studentList = Student::where('assignedTo', Auth::user()->id)
            ->orderBy('id', 'asc')
            ->paginate(10);
         return view('employees.students.index', [
            'studentList' => $studentList,
            'countries' => $countries
         ]);
      } else {
         return "You have no permission to access this page";
      }
   }

   // Student search by country
   public function studentSearchCountry(Request $request)
   {
      $countryStudents = Student::where('country', $request->country)->paginate('10');
      $countries = CountryList::all();
      return view('superAdmin.students.countrySearch', ['countryStudents' => $countryStudents, 'countries' => $countries]);
   }
   //view Student profile
   public function viewStudent($id)
   {
      $student = User::find($id);
      return view('superAdmin.students.view', ['student' => $student]);
   }
   //edit Student profile
   public function editStudent($id)
   {
      $student = User::find($id);
      $countries = CountryList::all();
      $employees = Employees::whereNot('id', 1)->get();
      return view('superAdmin.students.edit', ['student' => $student, 'countries' => $countries, 'employees' => $employees]);
   }
   //Student photoUpdate
   public function photoUpdateStudent(Request $request)
   {
      $url = "storage/";
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;

      Student::where('userId', $request->userId)->update([
         'photo' => $photo_path,
      ]);
      // Save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => "{$authEmployee->firstName} {$authEmployee->lastName} has updated Profile Photo of student id: {$request->id}",
      ]);
      session()->flash('success', 'Photo updated successfully..!!');
      return redirect()->back();
   }
   //Student infoUpdate
   public function infoUpdateStudent(Request $request)
   {
      //return $request->all();

      // Fetch the current student record from the database
      $currentStudent = Student::where('userId', $request->id)->first();

      // save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => $authEmployee->firstName . ' ' . $authEmployee->lastName . ' has updated Student id : ' . $request->id,
      ]);

      // List of fields to compare and update
      $fieldsToCheck = [
         'firstName',
         'lastName',
         'fathersName',
         'mothersName',
         'gender',
         'dob',
         'phone',
         'gurdianPhone',
         'country',
         'councilorComments',
         'managerComment',
         'academicQualification',
         'epGroup',
         'epScore',
         'workExperience',
         'paymentMethods',
         'payAmount',
         'paymentDescription',
         'leadSource',
         'accHolderName',
         'accNumber',
         'bankName',
         'branch',
         'branchCode',
         'joinDate',
         'leavingDate',
         'currentDate',
         'remindDate',
         'followupFor',
         'assignedTo',
         'status',
         'weightage'
      ];

      // Array to hold updated fields
      $updatedFields = ['userId' => $request->id];

      // Loop through each field and compare values
      foreach ($fieldsToCheck as $field) {
         if ($currentStudent->$field !== $request->$field) {
            $updatedFields[$field] = $request->$field;
         }
      }

      // Update the student record if there are any changes
      if (count($updatedFields) > 1) {  // Check if there are fields other than userId
         $updateStudents = $currentStudent->update($updatedFields);
         if ($updateStudents) {
            $updatedFields['logId'] = $logData->id;
            StudentsUpdateFields::create($updatedFields);
         }
      }

      session()->flash('success', 'Employee Info updated successfully..!!');
      return redirect()->back();
   }
   //delete Student profile
   public function deleteStudent($id)
   {
      User::destroy($id);
      // save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => $authEmployee->firstName . ' ' . $authEmployee->lastName . ' has deleted Student id : ' . $id,
      ]);
      session()->flash('delete', 'Account Deleted ..!!');
      return redirect()->back();
   }



   // Client section starts here
   public function clientList()
   {
      $users = User::where('userType', 4)->get();
      return view('superAdmin.clients.index', ['users' => $users]);
   }
   //view clients profile
   public function viewClient($id)
   {
      $client = User::find($id);
      return view('superAdmin.clients.view', ['client' => $client]);
   }
   public function setProfileClient()
   {
      $userTypes = UserType::whereNot('id', 1)->get();
      $departments = Department::all();
      $designations = Designation::all();

      return view('pages.clients.setProfile', ['userTypes' => $userTypes, 'departments' => $departments, 'designations' => $designations]);
   }
   public function setProfileDataClient(Request $request)
   {

      // return $request->all();
      // Save the user's photo
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;

      // update client data
      Clients::where('userId', $request->profileId)->update([
         'fathersName' => $request->fathersName,
         'gender' => $request->gender,
         'dob' => $request->dob,
         'phone2' => $request->phone2,
         'referenceName' => $request->referenceName,
         'referencePhone' => $request->referencePhone,
         'govId' => $request->govId,
         'govIdNo' => $request->govIdNo,
         'address1' => $request->address1,
         'townCity1' => $request->townCity1,
         'postZipCode1' => $request->postZipCode1,
         'state1' => $request->state1,
         'country1' => $request->country1,
         'address2' => $request->address2,
         'townCity2' => $request->townCity2,
         'postZipCode2' => $request->postZipCode2,
         'state2' => $request->state2,
         'country2' => $request->country2,
         'joinDate' => $request->joinDate,
         'leaveDate' => $request->leaveDate,
         'status' => $request->status,
         'photo' => $photo_path,
      ]);

      Financial::where('userId', $request->profileId)->update([
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'bankName' => $request->bankName,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankSortCode' => $request->bankSortCode,
         'bankRoutingCode' => $request->bankRoutingCode,
         'swiftCode' => $request->swiftCode,
         'address1' => $request->address1,
         'address2' => $request->address2,
         'townCity' => $request->townCity,
         'stateProvision' => $request->stateProvision,
         'country' => $request->country,
      ]);

      // Flash a success message and redirect back
      session()->flash('success', 'Profile data updated successfully..!!');
      return redirect()->route('dashboard.client');
   }

   //add client form
   public function createClient()
   {
      $userTypes = UserType::whereNot('id', 1)->paginate(10);
      $departments = Department::all();
      $designations = Designation::all();
      return view('superAdmin.clients.create', ['userTypes' => $userTypes, 'departments' => $departments, 'designations' => $designations]);
   }

   public function storeClient(Request $request)
   {
      // return $request->all();
      // Generate a random password
      $autoPassword = Str::random(8);
      // Save the user's photo
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;
      // store  user data
      $user = User::create([
         'userType' => $request->userType,
         'email' => $request->email,
         'password' => Hash::make($autoPassword),
      ]);

      $phoneNumber = $request->countryCode . $request->phone;

      // store client data
      $client = Clients::create([
         'userId' => $user->id,
         'firstName' => $request->firstName,
         'lastName' => $request->lastName,
         'nickName' => $request->nickName,
         'phone1' => $phoneNumber,
         'whatsappNo' => $request->whatsappNo,
         'fathersName' => $request->fathersName,
         'gender' => $request->gender,
         'dob' => $request->dob,
         'phone2' => $request->phone2,
         'referenceName' => $request->referenceName,
         'referencePhone' => $request->referencePhone,
         'govId' => $request->govId,
         'govIdNo' => $request->govIdNo,
         'address1' => $request->address1,
         'townCity1' => $request->townCity1,
         'postZipCode1' => $request->postZipCode1,
         'state1' => $request->state1,
         'country1' => $request->country1,
         'address2' => $request->address2,
         'townCity2' => $request->townCity2,
         'postZipCode2' => $request->postZipCode2,
         'state2' => $request->state2,
         'country2' => $request->country2,
         'joinDate' => $request->joinDate,
         'leaveDate' => $request->leaveDate,
         'status' => $request->status,
         'photo' => $photo_path,
      ]);

      // store financial data
      $financial = Financial::create([
         'userId' => $user->id,
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'bankName' => $request->bankName,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankSortCode' => $request->bankSortCode,
         'bankRoutingCode' => $request->bankRoutingCode,
         'swiftCode' => $request->swiftCode,
         'address1' => $request->address1,
         'address2' => $request->address2,
         'townCity' => $request->townCity,
         'stateProvision' => $request->stateProvision,
         'country' => $request->country,
      ]);

      // Send the login details to the user's email
      Mail::send('notification.clientInvitation', ['user' => $user, 'password' => $autoPassword], function ($message) use ($user) {
         $message->to($user->email)->subject('Your account has been created successfully');
      });

      // Flash a success message and redirect back
      session()->flash('success', 'Client created successfully..!!');
      return redirect()->back();
   }

   public function editClient($id)
   {
      $client = User::find($id);
      $departments = Department::all();
      $designations = Designation::all();
      return view('superAdmin.clients.edit', ['client' => $client, 'departments' => $departments, 'designations' => $designations]);
   }

   //delete clients profile
   public function deleteClient($id)
   {
      User::destroy($id);
      Clients::destroy($id);
      Financial::destroy($id);
      session()->flash('delete', 'Account Deleted ..!!');
      return redirect()->back();
   }

   //clients photoUpdate
   public function photoUpdateClient(Request $request)
   {
      $url = "storage/";
      $photo = $request->file('photo');
      $photo_name = $photo->getClientOriginalName();
      $photo_storage = $photo->storeAs("public/uploads", $photo_name);
      $photo_path = 'storage/uploads/' . $photo_name;

      Clients::where('userId', $request->userId)->update([
         'photo' => $photo_path,
      ]);
      session()->flash('success', 'Photo updated successfully..!!');
      return redirect()->back();
   }
   //Clients infoUpdate
   public function infoUpdateClient(Request $request)
   {
      Clients::where('userId', $request->id)->update([
         'firstName' => $request->firstName,
         'lastName' => $request->lastName,
         'fathersName' => $request->fathersName,
         'gender' => $request->gender,
         'dob' => $request->dob,
         'phone' => $request->phone,
         'presentAddress' => $request->presentAddress,
         'permanentAddress' => $request->permanentAddress,
         'referenceName' => $request->referenceName,
         'referencePhone' => $request->referencePhone,
         'govId' => $request->govId,
         'govIdNo' => $request->govIdNo,
      ]);
      session()->flash('success', 'Client Info updated successfully..!!');
      return redirect()->back();
   }
   //Clients companyInfoUpdate
   public function companyInfoUpdateClient(Request $request)
   {
      Clients::where('userId', $request->id)->update([
         'department' => $request->department,
         'designation' => $request->designation,
         'joinDate' => $request->joinDate,
         'leaveDate' => $request->leaveDate,
         'status' => $request->status,
         'shift' => $request->shift,
         'hiringManager' => $request->hiringManager,
      ]);
      session()->flash('success', 'Company Info updated successfully..!!');
      return redirect()->back();
   }
   //Clients financialInfoUpdate
   public function financialInfoUpdateClient(Request $request)
   {
      Financial::where('userId', $request->id)->update([
         'salaryType' => $request->salaryType,
         'payScale' => $request->payScale,
         'accHolderName' => $request->accHolderName,
         'accNumber' => $request->accNumber,
         'bankName' => $request->bankName,
         'branch' => $request->branch,
         'branchCode' => $request->branchCode,
      ]);
      session()->flash('success', 'Financial Info updated successfully..!!');
      return redirect()->back();
   }
}
