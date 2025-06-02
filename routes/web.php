<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalculatorDataController;
use App\Http\Controllers\CalculatorRequestController;

Route::get('/', function () {
    return view('index');
});

Route::get('/calc', function () {
    return view('calc');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/galery', function () {
    return view('galery');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/admin', function () {
    return view('admin');
});

// Маршруты для аутентификации в админ-панель
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/check-auth', [AdminController::class, 'checkAuth'])->name('admin.check-auth');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// API маршруты для админ-панели
Route::prefix('admin/api')->group(function () {
    Route::get('/data', [AdminController::class, 'getAllData'])->name('admin.data');
    Route::get('/data/{table}', [AdminController::class, 'getTableData'])->name('admin.table-data');
    Route::post('/data/{table}', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/data/{table}/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/data/{table}/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

Route::post('/send-feedback', [FeedbackController::class, 'sendFeedback'])->name('send.feedback');

// Маршруты для API данных калькулятора
Route::prefix('api/calculator')->group(function () {
    Route::get('/data', [CalculatorDataController::class, 'getAllData'])->name('calculator.all-data');
    Route::get('/house-types', [CalculatorDataController::class, 'getHouseTypes'])->name('calculator.house-types');
    Route::get('/floors', [CalculatorDataController::class, 'getFloors'])->name('calculator.floors');
    Route::get('/roofs', [CalculatorDataController::class, 'getRoofs'])->name('calculator.roofs');
    Route::get('/materials', [CalculatorDataController::class, 'getMaterials'])->name('calculator.materials');
    Route::get('/foundations', [CalculatorDataController::class, 'getFoundations'])->name('calculator.foundations');
    Route::get('/facades', [CalculatorDataController::class, 'getFacades'])->name('calculator.facades');
    Route::get('/electrical', [CalculatorDataController::class, 'getElectrical'])->name('calculator.electrical');
    Route::get('/wall-finishes', [CalculatorDataController::class, 'getWallFinishes'])->name('calculator.wall-finishes');
    Route::get('/additions', [CalculatorDataController::class, 'getAdditions'])->name('calculator.additions');
});

// Маршрут для отправки заявок калькулятора
Route::post('/api/calculator/submit-request', [CalculatorRequestController::class, 'submitRequest'])->name('calculator.submit-request');
