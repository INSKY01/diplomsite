<?php

namespace App\Http\Controllers;

use App\Models\HouseType;
use App\Models\Floor;
use App\Models\Roof;
use App\Models\Material;
use App\Models\Foundation;
use App\Models\Facade;
use App\Models\Electrical;
use App\Models\WallFinish;
use App\Models\Addition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculatorDataController extends Controller
{
    /**
     * Получить все данные для калькулятора
     */
    public function getAllData()
    {
        // Запросы к соответствующим моделям
        $data = [
            'houseTypes' => $this->getHouseTypes(),
            'floors' => $this->getFloors(),
            'roofs' => $this->getRoofs(),
            'materials' => $this->getMaterials(),
            'foundations' => $this->getFoundations(),
            'facades' => $this->getFacades(),
            'electrical' => $this->getElectrical(),
            'wallFinishes' => $this->getWallFinishes(),
            'additions' => $this->getAdditions(),
            'requests' => [], // Запросы доступны только для админов
        ];

        return response()->json($data);
    }

    /**
     * Получить материалы для конкретного типа дома
     */
    public function getMaterialsByHouseType($houseTypeId)
    {
        $houseType = HouseType::findOrFail($houseTypeId);
        return response()->json($houseType->materials);
    }

    /**
     * Получить типы домов
     */
    public function getHouseTypes()
    {
        return HouseType::all();
    }

    /**
     * Редактирование типа дома
     */
    public function editHouseType($id)
    {
        return HouseType::findOrFail($id);
    }

    /**
     * Сохранение типа дома
     */
    public function storeHouseType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $houseType = HouseType::create($validated);
        return response()->json($houseType, 201);
    }

    /**
     * Обновление типа дома
     */
    public function updateHouseType(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $houseType = HouseType::findOrFail($id);
        $houseType->update($validated);
        return response()->json($houseType);
    }

    /**
     * Удаление типа дома
     */
    public function deleteHouseType($id)
    {
        $houseType = HouseType::findOrFail($id);
        $houseType->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить этажи
     */
    public function getFloors()
    {
        return Floor::all();
    }

    /**
     * Редактирование этажа
     */
    public function editFloor($id)
    {
        return Floor::findOrFail($id);
    }

    /**
     * Сохранение этажа
     */
    public function storeFloor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'multiplier' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $floor = Floor::create($validated);
        return response()->json($floor, 201);
    }

    /**
     * Обновление этажа
     */
    public function updateFloor(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'multiplier' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $floor = Floor::findOrFail($id);
        $floor->update($validated);
        return response()->json($floor);
    }

    /**
     * Удаление этажа
     */
    public function deleteFloor($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить типы крыш
     */
    public function getRoofs()
    {
        return Roof::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование крыши
     */
    public function editRoof($id)
    {
        return Roof::findOrFail($id);
    }

    /**
     * Сохранение крыши
     */
    public function storeRoof(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $roof = Roof::create($validated);
        return response()->json($roof, 201);
    }

    /**
     * Обновление крыши
     */
    public function updateRoof(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $roof = Roof::findOrFail($id);
        $roof->update($validated);
        return response()->json($roof);
    }

    /**
     * Удаление крыши
     */
    public function deleteRoof($id)
    {
        $roof = Roof::findOrFail($id);
        $roof->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить материалы
     */
    public function getMaterials()
    {
        return Material::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование материала
     */
    public function editMaterial($id)
    {
        return Material::findOrFail($id);
    }

    /**
     * Сохранение материала
     */
    public function storeMaterial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $material = Material::create($validated);
        
        // Автоматически связываем новый материал с типом дома "Другое" (id=5)
        // чтобы он отображался в калькуляторе
        $otherHouseType = HouseType::where('name', 'Другое')->first();
        if ($otherHouseType) {
            $material->houseTypes()->attach($otherHouseType->id);
        }
        
        return response()->json($material, 201);
    }

    /**
     * Обновление материала
     */
    public function updateMaterial(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $material = Material::findOrFail($id);
        $material->update($validated);
        return response()->json($material);
    }

    /**
     * Удаление материала
     */
    public function deleteMaterial($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить фундаменты
     */
    public function getFoundations()
    {
        return Foundation::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование фундамента
     */
    public function editFoundation($id)
    {
        return Foundation::findOrFail($id);
    }

    /**
     * Сохранение фундамента
     */
    public function storeFoundation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $foundation = Foundation::create($validated);
        return response()->json($foundation, 201);
    }

    /**
     * Обновление фундамента
     */
    public function updateFoundation(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $foundation = Foundation::findOrFail($id);
        $foundation->update($validated);
        return response()->json($foundation);
    }

    /**
     * Удаление фундамента
     */
    public function deleteFoundation($id)
    {
        $foundation = Foundation::findOrFail($id);
        $foundation->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить фасады
     */
    public function getFacades()
    {
        return Facade::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование фасада
     */
    public function editFacade($id)
    {
        return Facade::findOrFail($id);
    }

    /**
     * Сохранение фасада
     */
    public function storeFacade(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $facade = Facade::create($validated);
        return response()->json($facade, 201);
    }

    /**
     * Обновление фасада
     */
    public function updateFacade(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $facade = Facade::findOrFail($id);
        $facade->update($validated);
        return response()->json($facade);
    }

    /**
     * Удаление фасада
     */
    public function deleteFacade($id)
    {
        $facade = Facade::findOrFail($id);
        $facade->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить электрику
     */
    public function getElectrical()
    {
        return Electrical::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование электрики
     */
    public function editElectrical($id)
    {
        return Electrical::findOrFail($id);
    }

    /**
     * Сохранение электрики
     */
    public function storeElectrical(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'sockets' => 'nullable|integer',
            'switches' => 'nullable|integer',
            'lights' => 'nullable|integer',
        ]);

        $electrical = Electrical::create($validated);
        return response()->json($electrical, 201);
    }

    /**
     * Обновление электрики
     */
    public function updateElectrical(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'sockets' => 'nullable|integer',
            'switches' => 'nullable|integer',
            'lights' => 'nullable|integer',
        ]);

        $electrical = Electrical::findOrFail($id);
        $electrical->update($validated);
        return response()->json($electrical);
    }

    /**
     * Удаление электрики
     */
    public function deleteElectrical($id)
    {
        $electrical = Electrical::findOrFail($id);
        $electrical->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить отделку стен
     */
    public function getWallFinishes()
    {
        return WallFinish::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование отделки стен
     */
    public function editWallFinish($id)
    {
        return WallFinish::findOrFail($id);
    }

    /**
     * Сохранение отделки стен
     */
    public function storeWallFinish(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $wallFinish = WallFinish::create($validated);
        return response()->json($wallFinish, 201);
    }

    /**
     * Обновление отделки стен
     */
    public function updateWallFinish(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $wallFinish = WallFinish::findOrFail($id);
        $wallFinish->update($validated);
        return response()->json($wallFinish);
    }

    /**
     * Удаление отделки стен
     */
    public function deleteWallFinish($id)
    {
        $wallFinish = WallFinish::findOrFail($id);
        $wallFinish->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Получить дополнения
     */
    public function getAdditions()
    {
        return Addition::orderByRaw("CASE WHEN name = 'Другое' THEN 1 ELSE 0 END, id")->get();
    }

    /**
     * Редактирование дополнения
     */
    public function editAddition($id)
    {
        return Addition::findOrFail($id);
    }

    /**
     * Сохранение дополнения
     */
    public function storeAddition(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'required|string',
        ]);

        $addition = Addition::create($validated);
        return response()->json($addition, 201);
    }

    /**
     * Обновление дополнения
     */
    public function updateAddition(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'required|string',
        ]);

        $addition = Addition::findOrFail($id);
        $addition->update($validated);
        return response()->json($addition);
    }

    /**
     * Удаление дополнения
     */
    public function deleteAddition($id)
    {
        $addition = Addition::findOrFail($id);
        $addition->delete();
        return response()->json(['success' => true]);
    }
} 