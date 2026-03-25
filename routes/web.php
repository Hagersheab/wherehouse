<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ExportController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('departments', DepartmentController::class);
    Route::get('user', [UserController::class , 'index'])->name('user.index');
    Route::get('user/{id}/edit', [UserController::class , 'edit'])->name('user.edit');
    Route::put('user/{id}', [UserController::class , 'update'])->name('user.update');


    // Route::resource('import', ImportController::class)->middleware('canImport');
    // Route::resource('export', ExportController::class)->middleware('canExport');


    Route::get('/import/create', [ImportController::class , 'create'])->name('imports.create');
    Route::post('/import', [ImportController::class , 'store'])->name('imports.store');
    Route::get('/import', [ImportController::class , 'index'])->name('imports.index');
    Route::post('/import/{import}/conferm', [ImportController::class , 'conferm'])->name('imports.confirm');
    Route::get('/import/show/{import}', [ImportController::class , 'show'])->name('imports.show');


    route::get('/warehouse', [WarehouseController::class , 'index'])->name('warehouse.index');
    route::get('export', [ExportController::class , 'index'])->name('exports.index');
    route::get('/export/create', [ExportController::class , 'create'])->name('exports.create');
    route::post('/export', [ExportController::class , 'store'])->name('exports.store');
    route::get('/export/show/{export}', [ExportController::class , 'show'])->name('exports.show');
    route::post('/export/{export}/deliver', [ExportController::class , 'deliver'])->name('exports.deliver');
    
    
});

require __DIR__ . '/auth.php';
;