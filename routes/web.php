<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignedController;
use App\Http\Controllers\Employee\AsiController;
use App\Http\Controllers\Employee\EmpAuthController;
use App\Http\Controllers\Employee\EmpController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('root');
});

// This is for the Admin Route 
Route::group(['middleware' => 'admin.guest'], function () {
    Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'authLogin'])->name('admin.processLogin');
});

Route::group(['middleware' => 'admin.auth'], function () {
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/admin', [EmployeeController::class, 'allEmployee'])->name('home');
    Route::get('/hierarchy', [AssignedController::class, 'hierarchy'])->name('employee.hierarchy')->middleware('auth');

    /*
     * Employee Route
     */
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/post', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/one/{employeeId}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/edit/{employeeId}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/update/{employeeId}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/delete/{employeeId}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/specific', [EmployeeController::class, 'getSpecificAssignedEmployee'])->name('employee.getSpecifiedEmployee');

    /*
     * Role Route
     */
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/post', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/one/{roleId}', [RoleController::class, 'show'])->name('role.show');
    Route::get('/role/edit/{roleId}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/update/{roleId}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/delete/{roleId}', [RoleController::class, 'destroy'])->name('role.destroy');

    /*
     * Assigned To Route
     */
    Route::get('/assign', [AssignedController::class, 'index'])->name('assign.index');
    Route::get('/assign/data', [AssignedController::class, 'allData'])->name('assign.allData');
    Route::get('/assign/create', [AssignedController::class, 'create'])->name('assign.create');
    Route::post('/assign/post', [AssignedController::class, 'store'])->name('assign.store');
    Route::get('/assign/one/{assignId}', [AssignedController::class, 'show'])->name('assign.show');
    Route::get('/assign/edit/{assignId}', [AssignedController::class, 'edit'])->name('assign.edit');
    Route::put('/assign/update/{assignId}', [AssignedController::class, 'update'])->name('assign.update');
    Route::delete('/assign/delete/{assignId}', [AssignedController::class, 'destroy'])->name('assign.destroy');
    Route::get('/assign/specific', [AssignedController::class, 'getUnderEmployee'])->name('assign.getUnderEmployee');
    Route::get('/assign/teamMember', [AssignedController::class, 'getTeamMemberData'])->name('assign.getTeamMember');
});


// This is for the Employee Route
Route::group(['middleware' => 'employee.guest'], function () {
    // This is for the User Only
    Route::get('/auth/login', [EmpAuthController::class, 'index'])->name('employee.login');
    Route::post('/auth/processLogin', [EmpAuthController::class, 'authLogin'])->name('employee.processLogin');
    Route::get('/auth/register', [EmpAuthController::class, 'register'])->name('employee.register');
    Route::post('/auth/processRegister', [EmpAuthController::class, 'authRegister'])->name('employee.processRegister');
});


Route::group(['middleware' => 'employee.auth'], function () {
    Route::get('/auth/logout', [EmpAuthController::class, 'logout'])->name('employee.logout');
    Route::get('/home', [EmpController::class, 'allEmployee'])->name('employee.home');

    Route::get('/emphierarchy', [AsiController::class, 'hierarchy'])->name('auth.employee.hierarchy');

    /*
     * Employee Route
     */
    Route::get('/auth/employee', [EmpController::class, 'index'])->name('auth.employee.index');
    Route::get('/auth/employee/one/{employeeId}', [EmpController::class, 'show'])->name('auth.employee.show');
    Route::get('/auth/employee/specific', [EmpController::class, 'getSpecificAssignedEmployee'])->name('auth.employee.getSpecifiedEmployee');
    Route::get('/auth/assign/specific', [AsiController::class, 'getUnderEmployee'])->name('auth.assign.getUnderEmployee');
    Route::get('/auth/assign/teamMember', [AsiController::class, 'getTeamMemberData'])->name('auth.assign.getTeamMemberData');
});