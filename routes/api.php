<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorDataController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\HouseTypeController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoofController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\FoundationController;
use App\Http\Controllers\FacadeController;
use App\Http\Controllers\ElectricalController;
use App\Http\Controllers\WallFinishController;
use App\Http\Controllers\AdditionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Маршрут для получения всех данных калькулятора
Route::get('/calculator-data', [CalculatorDataController::class, 'getAllData']);

// Отдельные маршруты для получения данных по категориям
Route::get('/calculator/house-types', [CalculatorDataController::class, 'getHouseTypes']);
Route::get('/calculator/floors', [CalculatorDataController::class, 'getFloors']);
Route::get('/calculator/roofs', [CalculatorDataController::class, 'getRoofs']);
Route::get('/calculator/materials', [CalculatorDataController::class, 'getMaterials']);
Route::get('/calculator/foundations', [CalculatorDataController::class, 'getFoundations']);
Route::get('/calculator/facades', [CalculatorDataController::class, 'getFacades']);
Route::get('/calculator/electrical', [CalculatorDataController::class, 'getElectrical']);
Route::get('/calculator/wall-finishes', [CalculatorDataController::class, 'getWallFinishes']);
Route::get('/calculator/additions', [CalculatorDataController::class, 'getAdditions']);

// Ресурсные маршруты для управления категориями через контроллеры моделей
Route::apiResource('calculator/house-types', HouseTypeController::class);
Route::apiResource('calculator/floors', FloorController::class);
Route::apiResource('calculator/roofs', RoofController::class);
Route::apiResource('calculator/materials', MaterialController::class);
Route::apiResource('calculator/foundations', FoundationController::class);
Route::apiResource('calculator/facades', FacadeController::class);
Route::apiResource('calculator/electrical', ElectricalController::class);
Route::apiResource('calculator/wall-finishes', WallFinishController::class);
Route::apiResource('calculator/additions', AdditionController::class);

// CRUD маршруты для CalculatorDataController
// HouseTypes
Route::get('/calculator/house-type/{id}', [CalculatorDataController::class, 'editHouseType']);
Route::post('/calculator/house-type', [CalculatorDataController::class, 'storeHouseType']);
Route::put('/calculator/house-type/{id}', [CalculatorDataController::class, 'updateHouseType']);
Route::delete('/calculator/house-type/{id}', [CalculatorDataController::class, 'deleteHouseType']);

// Floors
Route::get('/calculator/floor/{id}', [CalculatorDataController::class, 'editFloor']);
Route::post('/calculator/floor', [CalculatorDataController::class, 'storeFloor']);
Route::put('/calculator/floor/{id}', [CalculatorDataController::class, 'updateFloor']);
Route::delete('/calculator/floor/{id}', [CalculatorDataController::class, 'deleteFloor']);

// Roofs
Route::get('/calculator/roof/{id}', [CalculatorDataController::class, 'editRoof']);
Route::post('/calculator/roof', [CalculatorDataController::class, 'storeRoof']);
Route::put('/calculator/roof/{id}', [CalculatorDataController::class, 'updateRoof']);
Route::delete('/calculator/roof/{id}', [CalculatorDataController::class, 'deleteRoof']);

// Materials
Route::get('/calculator/material/{id}', [CalculatorDataController::class, 'editMaterial']);
Route::post('/calculator/material', [CalculatorDataController::class, 'storeMaterial']);
Route::put('/calculator/material/{id}', [CalculatorDataController::class, 'updateMaterial']);
Route::delete('/calculator/material/{id}', [CalculatorDataController::class, 'deleteMaterial']);

// Foundations
Route::get('/calculator/foundation/{id}', [CalculatorDataController::class, 'editFoundation']);
Route::post('/calculator/foundation', [CalculatorDataController::class, 'storeFoundation']);
Route::put('/calculator/foundation/{id}', [CalculatorDataController::class, 'updateFoundation']);
Route::delete('/calculator/foundation/{id}', [CalculatorDataController::class, 'deleteFoundation']);

// Facades
Route::get('/calculator/facade/{id}', [CalculatorDataController::class, 'editFacade']);
Route::post('/calculator/facade', [CalculatorDataController::class, 'storeFacade']);
Route::put('/calculator/facade/{id}', [CalculatorDataController::class, 'updateFacade']);
Route::delete('/calculator/facade/{id}', [CalculatorDataController::class, 'deleteFacade']);

// Electrical
Route::get('/calculator/electrical/{id}', [CalculatorDataController::class, 'editElectrical']);
Route::post('/calculator/electrical', [CalculatorDataController::class, 'storeElectrical']);
Route::put('/calculator/electrical/{id}', [CalculatorDataController::class, 'updateElectrical']);
Route::delete('/calculator/electrical/{id}', [CalculatorDataController::class, 'deleteElectrical']);

// WallFinishes
Route::get('/calculator/wall-finish/{id}', [CalculatorDataController::class, 'editWallFinish']);
Route::post('/calculator/wall-finish', [CalculatorDataController::class, 'storeWallFinish']);
Route::put('/calculator/wall-finish/{id}', [CalculatorDataController::class, 'updateWallFinish']);
Route::delete('/calculator/wall-finish/{id}', [CalculatorDataController::class, 'deleteWallFinish']);

// Additions
Route::get('/calculator/addition/{id}', [CalculatorDataController::class, 'editAddition']);
Route::post('/calculator/addition', [CalculatorDataController::class, 'storeAddition']);
Route::put('/calculator/addition/{id}', [CalculatorDataController::class, 'updateAddition']);
Route::delete('/calculator/addition/{id}', [CalculatorDataController::class, 'deleteAddition']);

// Маршруты для запросов
Route::post('/requests', [RequestController::class, 'store']);
Route::get('/requests', [RequestController::class, 'index']);
Route::put('/requests/{id}/status', [RequestController::class, 'updateStatus']); 