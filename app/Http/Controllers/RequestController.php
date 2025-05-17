<?php

namespace App\Http\Controllers;

use App\Models\Request as HouseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    /**
     * Сохранить новый запрос
     */
    public function store(Request $request)
    {
        // Валидация запроса
        $validator = Validator::make($request->all(), [
            'houseType' => 'required|integer',
            'area' => 'required|numeric|min:50|max:1000',
            'floor' => 'required|integer',
            'roof' => 'required|integer',
            'material' => 'required|integer',
            'foundation' => 'required|integer',
            'facade' => 'required|integer',
            'electrical' => 'required|integer',
            'wallFinish' => 'required|integer',
            'additions' => 'nullable|array',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'comment' => 'nullable|string|max:1000',
            'totalPrice' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        // Создание нового запроса
        $houseRequest = new HouseRequest();
        $houseRequest->house_type_id = $request->houseType;
        $houseRequest->area = $request->area;
        $houseRequest->floor_id = $request->floor;
        $houseRequest->roof_id = $request->roof;
        $houseRequest->material_id = $request->material;
        $houseRequest->foundation_id = $request->foundation;
        $houseRequest->facade_id = $request->facade;
        $houseRequest->electrical_id = $request->electrical;
        $houseRequest->wall_finish_id = $request->wallFinish;
        $houseRequest->additions = json_encode($request->additions);
        $houseRequest->name = $request->name;
        $houseRequest->phone = $request->phone;
        $houseRequest->email = $request->email;
        $houseRequest->comment = $request->comment;
        $houseRequest->total_price = $request->totalPrice;
        $houseRequest->status = 'new';
        $houseRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Запрос успешно сохранен',
            'request' => $houseRequest
        ], 201);
    }

    /**
     * Получить все запросы (только для админов)
     */
    public function index(Request $request)
    {
        // Проверка аутентификации админа
        if (!session('admin_authenticated')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Получаем все запросы с сортировкой по дате создания (новые вверху)
        $requests = HouseRequest::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'requests' => $requests
        ]);
    }

    /**
     * Обновить статус запроса (только для админов)
     */
    public function updateStatus(Request $request, $id)
    {
        // Проверка аутентификации админа
        if (!session('admin_authenticated')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Валидация запроса
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:new,in_progress,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        // Получаем запрос
        $houseRequest = HouseRequest::find($id);
        
        if (!$houseRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Запрос не найден'
            ], 404);
        }

        // Обновляем статус
        $houseRequest->status = $request->status;
        $houseRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Статус успешно обновлен',
            'request' => $houseRequest
        ]);
    }
} 