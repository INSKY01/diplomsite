<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\HouseType;
use App\Models\Floor;
use App\Models\Material;
use App\Models\Foundation;
use App\Models\Roof;
use App\Models\Facade;
use App\Models\Electrical;
use App\Models\WallFinish;
use App\Models\Addition;
use App\Mail\CalculatorRequestMail;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CalculatorRequestController extends Controller
{
    public function submitRequest(HttpRequest $request)
    {
        try {
            // Валидация данных
            $validated = $request->validate([
                'house_type_id' => 'required|integer|exists:house_types,id',
                'area' => 'required|numeric|min:1',
                'floor_id' => 'required|integer|exists:floors,id',
                'roof_id' => 'required|integer|exists:roofs,id',
                'material_id' => 'required|integer|exists:materials,id',
                'foundation_id' => 'required|integer|exists:foundations,id',
                'facade_id' => 'required|integer|exists:facades,id',
                'electrical_id' => 'required|integer|exists:electricals,id',
                'wall_finish_id' => 'required|integer|exists:wall_finishes,id',
                'additions' => 'nullable|array',
                'additions.*' => 'integer|exists:additions,id',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'comment' => 'nullable|string|max:1000',
                'total_price' => 'required|numeric|min:0',
            ]);

            // Сохранение в базу данных
            $calculatorRequest = Request::create($validated);

            // Подготовка данных для письма
            $requestData = $validated;
            
            // Получение названий для email
            $requestData['houseTypeName'] = HouseType::find($validated['house_type_id'])->name ?? null;
            $requestData['floorName'] = Floor::find($validated['floor_id'])->name ?? null;
            $requestData['materialName'] = Material::find($validated['material_id'])->name ?? null;
            $requestData['foundationName'] = Foundation::find($validated['foundation_id'])->name ?? null;
            $requestData['roofName'] = Roof::find($validated['roof_id'])->name ?? null;
            $requestData['facadeName'] = Facade::find($validated['facade_id'])->name ?? null;
            $requestData['electricalName'] = Electrical::find($validated['electrical_id'])->name ?? null;
            $requestData['wallFinishName'] = WallFinish::find($validated['wall_finish_id'])->name ?? null;
            
            if (!empty($validated['additions'])) {
                $additions = Addition::whereIn('id', $validated['additions'])->pluck('name')->toArray();
                $requestData['additionsNames'] = implode(', ', $additions);
            }

            // Отправка email администратору
            try {
                Mail::to(env('MAIL_FROM_ADDRESS'))->send(new CalculatorRequestMail($requestData));
                Log::info('Email sent successfully for calculator request', ['request_id' => $calculatorRequest->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send email for calculator request', [
                    'request_id' => $calculatorRequest->id,
                    'error' => $e->getMessage()
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Заявка успешно отправлена!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for calculator request', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации данных',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Failed to submit calculator request', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при отправке заявки'
            ], 500);
        }
    }
} 