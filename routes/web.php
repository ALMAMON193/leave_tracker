<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveHistoryController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [LeaveRequestController::class, 'index'])->name('home');

// Leave request routes

Route::get('/leave-request', [LeaveRequestController::class, 'showLeaveRequestForm'])->name('leave.request');
Route::post('/leave-request', [LeaveRequestController::class, 'submitLeaveRequest'])->name('leave.submit');
Route::get('/leave-history', [LeaveHistoryController::class, 'showLeaveHistory'])->name('leave.history');


Route::put('/leave-requests/{leaveRequest}/approve', [LeaveRequestController::class, 'approveLeaveRequest'])->name('leave.approve')->middleware('is_admin');

Route::put('/leave-requests/{leaveRequest}/reject', [LeaveRequestController::class, 'rejectLeaveRequest'])->name('leave.reject')->middleware('is_admin');

Route::get('admin/dashboard', [AdminController::class, 'adminHome'])->name('admin.dashboard')->middleware('is_admin');
