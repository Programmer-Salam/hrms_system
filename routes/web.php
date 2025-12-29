<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SkillController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('employees.index');
    });

    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class)->only(['index', 'create', 'store']);
    Route::resource('skills', SkillController::class)->only(['index', 'create', 'store']);

    Route::post('/check-email', [EmployeeController::class, 'checkEmail'])->name('check.email');
});
