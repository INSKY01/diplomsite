<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoofController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\FoundationController;
use App\Http\Controllers\FacadeController;
use App\Http\Controllers\ElectricalController;
use App\Http\Controllers\WallFinishController;
use App\Http\Controllers\AdditionController;
use App\Http\Controllers\CalculatorDataController;
use Illuminate\Support\Facades\DB;

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

// Новые API маршруты для админ-панели
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

// Старые роуты для совместимости
Route::prefix('admin')->group(function () {
    Route::get('/types', [AdminController::class, 'getAllData'])->name('admin.types.index');
});

// Ресурсные маршруты для категорий
Route::resource('floors', FloorController::class);
Route::resource('roofs', RoofController::class);
Route::resource('materials', MaterialController::class);
Route::resource('foundations', FoundationController::class);
Route::resource('facades', FacadeController::class);
Route::resource('electrical', ElectricalController::class);
Route::resource('wall-finishes', WallFinishController::class);
Route::resource('additions', AdditionController::class);

// Тестовый маршрут для создания записей в таблице electrical
Route::get('/test-create-electrical', function() {
    $record1 = App\Models\Electrical::create([
        'name' => 'Базовая электрика',
        'description' => 'Минимальный набор розеток и выключателей',
        'price' => 50000,
        'sockets' => 10,
        'switches' => 8,
        'lights' => 12,
        'image' => '/img/electrical/basic.jpg'
    ]);
    
    $record2 = App\Models\Electrical::create([
        'name' => 'Стандарт',
        'description' => 'Стандартный набор розеток и выключателей',
        'price' => 80000,
        'sockets' => 20,
        'switches' => 15,
        'lights' => 20,
        'image' => '/img/electrical/standard.jpg'
    ]);
    
    return [
        'status' => 'success',
        'message' => 'Electrical records created',
        'records' => [
            $record1,
            $record2
        ]
    ];
});

// Тестовый маршрут для создания записей в таблице electrical
Route::get('/test-create-electrical-direct', function() {
    // Используем прямой запрос к базе данных
    $record1 = DB::table('electrical')->insertGetId([
        'name' => 'Базовая электрика',
        'description' => 'Минимальный набор розеток и выключателей',
        'price' => 50000,
        'sockets' => 10,
        'switches' => 8,
        'lights' => 12,
        'image' => '/img/electrical/basic.jpg',
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    $record2 = DB::table('electrical')->insertGetId([
        'name' => 'Стандарт',
        'description' => 'Стандартный набор розеток и выключателей',
        'price' => 80000,
        'sockets' => 20,
        'switches' => 15,
        'lights' => 20,
        'image' => '/img/electrical/standard.jpg',
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    $record3 = DB::table('electrical')->insertGetId([
        'name' => 'Премиум',
        'description' => 'Расширенный набор розеток и выключателей с умными системами',
        'price' => 120000,
        'sockets' => 30,
        'switches' => 25,
        'lights' => 35,
        'image' => '/img/electrical/premium.jpg',
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    return [
        'status' => 'success',
        'message' => 'Electrical records created directly',
        'records' => [
            $record1,
            $record2,
            $record3
        ]
    ];
});
