<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuggestionController;
use App\Http\Middleware\AdminSessionAuth;


Route::get('/',           [MainController::class, 'index'])->name('index');
Route::get('/search',     [MainController::class, 'search'])->name('search');
Route::get('/view',       [MainController::class, 'view'])->name('view');
Route::get('/suggestion',  [MainController::class, 'suggestion'])->name('suggestion');
Route::post('/suggestion', [MainController::class, 'suggestionStore'])->name('suggestion.store'); // ← جديد



Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware([AdminSessionAuth::class])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/medicines',                 [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('/medicines/create',          [MedicineController::class, 'create'])->name('medicines.create');
    Route::post('/medicines',                [MedicineController::class, 'store'])->name('medicines.store');
    Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
    Route::put('/medicines/{medicine}',      [MedicineController::class, 'update'])->name('medicines.update');
    Route::delete('/medicines/{medicine}',   [MedicineController::class, 'destroy'])->name('medicines.destroy');


    Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::post('/suggestions/{suggestion}/approve', [SuggestionController::class, 'approve'])->name('suggestions.approve');
    Route::post('/suggestions/{suggestion}/reject', [SuggestionController::class, 'reject'])->name('suggestions.reject');
});
});