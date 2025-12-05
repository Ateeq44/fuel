<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelEntryController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GasStationController;
use App\Http\Controllers\userFuelEntryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('isUser')->group(function () {
    Route::resource('user_fuel_entries', UserFuelEntryController::class)->parameters(['user_fuel_entries' => 'fuel_entry']);
});
Route::middleware('isAdmin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('fuel_entries', FuelEntryController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('gas_station', GasStationController::class);

    Route::get('admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
    Route::get('admin/reports/export/pdf', [AdminReportController::class, 'exportPDF'])->name('admin.reports.pdf');
    Route::get('admin/reports/export/excel', [AdminReportController::class, 'exportExcel'])->name('admin.reports.excel');

});



require __DIR__.'/auth.php';
