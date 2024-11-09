<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Clients\ClientProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DesignationsController;

Route::get('/', [AppController::class, 'index'])->name('main');

Route::get('/password-reset-notification', function () {
    return view('notification.password-request');
})->name('password.reset.notification');

Route::get('/dashboard', [DashboardController::class, 'projectDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

//Admin routes
Route::middleware('auth')->prefix('admin')->group(function () {
    //employees routes
    Route::get('/add-employee', [userController::class, 'createEmployee'])->name('admin.add.employee');
    Route::post('/add-employee', [userController::class, 'storeEmployee'])->name('admin.add.employee');
    Route::get('/employee-list', [userController::class, 'employeeList'])->name('admin.employee.list');
    Route::get('/employee-view/{id}', [UserController::class, 'viewEmployee'])->name('admin.view.employee');
    Route::get('/employee-edit/{id}', [UserController::class, 'editEmployee'])->name('admin.edit.employee');
    Route::post('/employee-photo-update', [UserController::class, 'photoUpdateEmployee'])->name('admin.photoUpdate.employee');
    Route::post('/employee-info-update', [UserController::class, 'infoUpdateEmployee'])->name('admin.infoUpdate.employee');
    Route::post('/employee-company-info-update', [UserController::class, 'companyInfoUpdateEmployee'])->name('admin.companyInfoUpdate.employee');
    Route::post('/employee-financial-info-update', [UserController::class, 'financialInfoUpdateEmployee'])->name('admin.financialInfoUpdate.employee');
    Route::get('delete-employee/{id}', [UserController::class, 'deleteEmployee'])->name('admin.delete.employee');

    //student routes
    Route::get('/add-student', [userController::class, 'createStudent'])->name('admin.add.student');
    Route::post('/add-student', [userController::class, 'storeStudent'])->name('admin.add.student');
    Route::get('/student-list', [userController::class, 'studentist'])->name('admin.student.list');
    Route::post('/student-search-country', [userController::class, 'studentSearchCountry'])->name('admin.student.search.country');
    Route::get('/student-view/{id}', [UserController::class, 'viewStudent'])->name('admin.view.student');
    Route::get('/student-edit/{id}', [UserController::class, 'editStudent'])->name('admin.edit.student');
    Route::post('/student-photo-update', [UserController::class, 'photoUpdateStudent'])->name('admin.photoUpdate.student');
    Route::post('/student-info-update', [UserController::class, 'infoUpdateStudent'])->name('admin.infoUpdate.student');
    Route::get('delete-student/{id}', [UserController::class, 'deleteStudent'])->name('admin.delete.student');

    //projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::post('add-projects', [ProjectController::class, 'store'])->name('admin.add.project');
    Route::get('view-projects/{id}', [ProjectController::class, 'viewProject'])->name('admin.view.project');

    Route::get('employee-assign-projects', [ProjectController::class, 'assignEmployee'])->name('employee.assign');
    Route::post('employee-assign-projects', [ProjectController::class, 'storeAssignEmployee'])->name('employee.assign');
    Route::delete('delete-project/{project}', [ProjectController::class, 'deleteProject'])->name('project.delete');

    //attendence routes
    Route::get('/attendence', [AttendenceController::class, 'create'])->name('admin.attendence');
    Route::post('/add-attendence', [AttendenceController::class, 'storeAttendence'])->name('admin.add.attendence');
    Route::get('/attendence-report', [AttendenceController::class, 'report'])->name('admin.attendence.report');
    Route::get('delete-report/{id}', [AttendenceController::class, 'deleteReport'])->name('admin.delete.report');

    //company profile
    route::get('/setting-profile', [CompanyProfileController::class, 'index'])->name('setting.profile');
    route::post('/setting-profile-company-details', [CompanyProfileController::class, 'storeCompanyDetails'])->name('setting.profile.companyDetails');
    route::post('/setting-profile-logo-header-footer', [CompanyProfileController::class, 'storeLogoHeaderFooter'])->name('setting.profile.logoHeaderFooter');
    route::post('/setting-profile-payment-account', [CompanyProfileController::class, 'storePaymentAccount'])->name('setting.profile.paymentAccount');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //bugs route
    Route::get('/work-break',function(){
        return "bugs";
    })->name('employee.work.break');

    // Reports
    Route::get('/report', [ActivityLogController::class, 'index'])->name('admin.report');
    Route::get('/report-employee-log/{id}', [ActivityLogController::class, 'viewEmployeeLog'])->name('admin.report.viewEmployeeLog');
    Route::get('/report-student-log/{id}', [ActivityLogController::class, 'viewStudentLog'])->name('admin.report.viewStudentLog');
});

//Employee routes
Route::middleware('auth')->prefix('employee')->group(function () {
   
    Route::get('/dashboard', function () {
        return view('employees.dashboard');
    })->name('dashboard.employee');
    //student routes
    Route::get('/add-student', [userController::class, 'createStudent'])->name('employee.add.student');
    Route::post('/add-student', [userController::class, 'storeStudent'])->name('employee.add.student');
    Route::get('/student-list', [userController::class, 'studentist'])->name('employee.student.list');
    Route::post('/student-search-country', [userController::class, 'studentSearchCountry'])->name('employee.student.search.country');
    Route::get('/student-view/{id}', [UserController::class, 'viewStudent'])->name('employee.view.student');
    Route::get('/student-edit/{id}', [UserController::class, 'editStudent'])->name('employee.edit.student');
    Route::post('/student-photo-update', [UserController::class, 'photoUpdateStudent'])->name('employee.photoUpdate.student');
    Route::post('/student-info-update', [UserController::class, 'infoUpdateStudent'])->name('employee.infoUpdate.student');
    Route::get('delete-student/{id}', [UserController::class, 'deleteStudent'])->name('employee.delete.student');
});

//client routes
Route::middleware('auth')->prefix('client')->group(function () {
    //clients routes
    // Route::get('/client-list', [userController::class, 'index'])->name('admin.client.list');
    Route::get('/dashboard', function () {
        return view('clients.dashboard');
    })->name('dashboard.client');
    Route::get('/set-profiledata-client/', [userController::class, 'setProfileClient'])->name('set.profile.client');
    Route::post('/set-profiledata-client/', [userController::class, 'setProfileDataClient'])->name('set.profile.client');
    // Route::get('/employee-view/{id}',[UserController::class,'view'])->name('view.employee');
    // Route::get('/employee-edit/{id}',[UserController::class,'edit'])->name('edit.employee');
    // Route::get('/employee-delete/{id}',[UserController::class,'delete'])->name('delete.employee');
    // Route::post('/employee-photo-update',[UserController::class,'photoUpdate'])->name('photoUpdate.employee');
    // Route::post('/employee-info-update',[UserController::class,'infoUpdate'])->name('infoUpdate.employee');
    // Route::post('/employee-company-info-update',[UserController::class,'companyInfoUpdate'])->name('companyInfoUpdate.employee');
    // Route::post('/employee-financial-info-update',[UserController::class,'financialInfoUpdate'])->name('financialInfoUpdate.employee');



    //projects // 10-10-2023
    Route::get('/client-projects', [ClientProjectController::class, 'index'])->name('projects.client');
    route::get('/fetch-project/{id}', [ClientProjectController::class, 'fetchProject'])->name('projects.client.fetch');
});

//company profile
route::get('/setting-profile', [CompanyProfileController::class, 'index'])->name('setting.profile');
route::post('/setting-profile-company-details', [CompanyProfileController::class, 'storeCompanyDetails'])->name('setting.profile.companyDetails');
route::post('/setting-profile-logo-header-footer', [CompanyProfileController::class, 'storeLogoHeaderFooter'])->name('setting.profile.logoHeaderFooter');
route::post('/setting-profile-payment-account', [CompanyProfileController::class, 'storePaymentAccount'])->name('setting.profile.paymentAccount');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/auth.php';
