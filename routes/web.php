<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Clients\ClientController;
use App\Http\Controllers\Clients\ClientProjectController;
use App\Http\Controllers\ReportController;
use App\Models\Employees;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use App\Http\Controllers\Employees\EmployeeController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Employees\EmployeeProjectController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DesignationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('main');

Route::get('/password-reset-notification', function () {
    return view('notification.password-request');
})->name('password.reset.notification');

Route::get('/dashboard', [DashboardController::class, 'projectDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

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
    
    // Route::get('/client-list', [userController::class, 'clientList'])->name('admin.client.list');
    // Route::get('/export-users',[userController::class, 'exportUser'])->name('exportUser');
    // Route::get('/send-employee-link', [EmployeeController::class, 'sendLink'])->name('admin.sendLink.employee');
    // Route::post('/send-employee-link', [EmployeeController::class, 'sendLinkStore'])->name('admin.sendLink.employee');
    // Route::get('/send-client-link', [ClientController::class, 'sendLink'])->name('admin.sendLink.client');
    // Route::post('/send-client-link', [ClientController::class, 'sendLinkStore'])->name('admin.sendLink.client');

    //projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::post('add-projects', [ProjectController::class, 'store'])->name('admin.add.project');
    Route::get('view-projects/{id}', [ProjectController::class, 'viewProject'])->name('admin.view.project');

    Route::get('employee-assign-projects', [ProjectController::class, 'assignEmployee'])->name('employee.assign');
    Route::post('employee-assign-projects', [ProjectController::class, 'storeAssignEmployee'])->name('employee.assign');
    Route::delete('delete-project/{project}', [ProjectController::class, 'deleteProject'])->name('project.delete');


    //client routes
    // Route::get('/add-client', [userController::class, 'createClient'])->name('admin.add.client');
    // Route::post('/add-client', [userController::class, 'storeClient'])->name('admin.add.client');   
    // Route::get('/client-view/{id}',[UserController::class,'viewClient'])->name('admin.view.client');   
    // Route::get('/client-edit/{id}',[UserController::class,'editClient'])->name('admin.edit.client');
    // Route::get('/employee-delete/{id}',[UserController::class,'deleteEmployee'])->name('admin.delete.employee');
    // Route::get('/client-delete/{id}',[UserController::class,'deleteClient'])->name('admin.delete.client');   
    // Route::post('/client-photo-update',[UserController::class,'photoUpdateClient'])->name('admin.photoUpdate.client');   
    // Route::post('/client-info-update',[UserController::class,'infoUpdateClient'])->name('admin.infoUpdate.client');
    // Route::post('/client-company-info-update',[UserController::class,'companyInfoUpdateClient'])->name('admin.companyInfoUpdate.client');
    // Route::post('/client-financial-info-update',[UserController::class,'financialInfoUpdateClient'])->name('admin.financialInfoUpdate.client');


    //company profile
    route::get('/setting-profile', [CompanyProfileController::class, 'index'])->name('setting.profile');
    route::post('/setting-profile-company-details', [CompanyProfileController::class, 'storeCompanyDetails'])->name('setting.profile.companyDetails');
    route::post('/setting-profile-logo-header-footer', [CompanyProfileController::class, 'storeLogoHeaderFooter'])->name('setting.profile.logoHeaderFooter');
    route::post('/setting-profile-payment-account', [CompanyProfileController::class, 'storePaymentAccount'])->name('setting.profile.paymentAccount');

    //Departments
    route::get('/departments', [DepartmentsController::class, 'index'])->name('departments');
    route::post('/add-departments', [DepartmentsController::class, 'store'])->name('add.departments');
    route::get('/edit-departments/{id}', [DepartmentsController::class, 'edit'])->name('edit.departments');
    route::post('/update-departments', [DepartmentsController::class, 'update'])->name('update.departments');
    route::get('/fetch-admin-department', [DepartmentsController::class, 'fetchAdminDepartment'])->name('admin.fetch.departents');


    //Designation
    route::get('/designations', [DesignationsController::class, 'index'])->name('designations');
    route::post('/add-designations', [DesignationsController::class, 'store'])->name('add.designations');
    route::get('/edit-designations/{id}', [DesignationsController::class, 'edit'])->name('edit.designations');
    route::post('/update-designations', [DesignationsController::class, 'update'])->name('update.designations');
    route::get('/fetch-designation/{id}', [DesignationsController::class, 'fetchDesignation'])->name('admin.fetch.designation');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Activity Logs
    Route::get('/work-log', [ActivityLogController::class, 'showWorkLog'])->name('admin.work.logs');
    Route::get('/employee-log', [ActivityLogController::class, 'showEmployeeLog'])->name('admin.employee.logs');

    // Reports
    Route::get('/report', [ActivityLogController::class, 'index'])->name('admin.report');
    Route::get('/report-employee-log/{id}', [ActivityLogController::class, 'viewEmployeeLog'])->name('admin.report.viewEmployeeLog');
    Route::get('/report-student-log/{id}', [ActivityLogController::class, 'viewStudentLog'])->name('admin.report.viewStudentLog');
});

Route::middleware('auth')->prefix('employee')->group(function () {
    //employees routes
    // Route::get('/employee-list', [userController::class, 'index'])->name('admin.employee.list');
    Route::get('/dashboard', function () {
        return view('employees.dashboard');
    })->name('dashboard.employee');
    Route::get('{id}/projects/', [EmployeeProjectController::class, 'index'])->name('employee.projects');
    Route::post('/start-work', [EmployeeProjectController::class, 'workLogs'])->name('employee.start.work');
    Route::post('/work-break', [EmployeeProjectController::class, 'workBreak'])->name('employee.work.break');
    Route::get('/work-logs', [EmployeeProjectController::class, 'workLogHistory'])->name('employee.work.logs');
    Route::post('update-log-status', [EmployeeProjectController::class, 'updateStatus'])->name('employee.updateStatus');
    Route::get('end-day-log-status/{projectId}', [EmployeeProjectController::class, 'endOfDayStatus'])->name('employee.endOfDay');
    Route::get('/set-profiledata-employee/', [userController::class, 'setProfileEmployee'])->name('set.profile.employee');
    Route::post('/set-profiledata-employee/', [userController::class, 'setProfileDataEmployee'])->name('set.profile.employee');
    Route::get('/employee-view/{id}', [UserController::class, 'view'])->name('view.employee');
    Route::get('/employee-edit/{id}', [UserController::class, 'edit'])->name('edit.employee');
    Route::get('/employee-delete/{id}', [UserController::class, 'delete'])->name('delete.employee');
    Route::post('/employee-photo-update', [UserController::class, 'photoUpdate'])->name('photoUpdate.employee');
    Route::post('/employee-info-update', [UserController::class, 'infoUpdate'])->name('infoUpdate.employee');
    Route::post('/employee-company-info-update', [UserController::class, 'companyInfoUpdate'])->name('companyInfoUpdate.employee');
    Route::post('/employee-financial-info-update', [UserController::class, 'financialInfoUpdate'])->name('financialInfoUpdate.employee');
});

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
