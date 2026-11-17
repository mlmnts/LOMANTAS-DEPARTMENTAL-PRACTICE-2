<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('equipment.index'));

// 'auth' middleware: logged-in users only; guests are sent to the login page
Route::middleware('auth')->group(function () {
    // index, create, store, show, edit, update, destroy
    Route::resource('equipment', EquipmentController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'excel'])->name('reports.excel');
});

require __DIR__.'/auth.php';