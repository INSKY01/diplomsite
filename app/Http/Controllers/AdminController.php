<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Request as HouseRequest;
use App\Models\Feedback;

class AdminController extends Controller
{
    /**
     * Аутентификация в админ-панель
     */
    public function login(Request $request)
    {
        try {
            $password = $request->input('password');
            $correctPassword = env('ADMIN_PASSWORD', 'Respons1');
            
            if ($password === $correctPassword) {
                Session::put('admin_authenticated', true);
                return response()->json(['success' => true]);
            }
            
            return response()->json(['success' => false, 'message' => 'Неверный пароль'], 401);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ошибка аутентификации'], 500);
        }
    }
    
    /**
     * Проверка аутентификации
     */
    public function checkAuth()
    {
        try {
            $authenticated = Session::get('admin_authenticated', false);
            return response()->json(['authenticated' => $authenticated]);
        } catch (\Exception $e) {
            return response()->json(['authenticated' => false]);
        }
    }
    
    /**
     * Выход из админ-панели
     */
    public function logout()
    {
        try {
            Session::forget('admin_authenticated');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ошибка выхода'], 500);
        }
    }

    /**
     * Получить все данные для админки
     */
    public function getAllData()
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $data = [
                'houseTypes' => DB::table('house_types')->get(),
                'floors' => DB::table('floors')->get(),
                'roofs' => DB::table('roofs')->get(),
                'materials' => DB::table('materials')->get(),
                'foundations' => DB::table('foundations')->get(),
                'facades' => DB::table('facades')->get(),
                'electrical' => DB::table('electricals')->get(),
                'wallFinishes' => DB::table('wall_finishes')->get(),
                'additions' => DB::table('additions')->get(),
            ];
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка загрузки данных: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Получить данные конкретной таблицы
     */
    public function getTableData($table)
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electricals', 'wall_finishes', 'additions', 'requests', 'feedback'];
        
        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Недопустимая таблица'], 400);
        }

        try {
            if ($table === 'requests') {
                $data = HouseRequest::with(['houseType', 'floor', 'roof', 'material', 'foundation', 'facade', 'electrical', 'wallFinish'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($table === 'feedback') {
                $data = Feedback::orderBy('created_at', 'desc')->get();
            } else {
                $data = DB::table($table)->get();
            }
            
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка загрузки данных: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Получить статистику заявок
     */
    public function getRequestsStats()
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $stats = [
                'total_requests' => HouseRequest::count(),
                'new_requests' => HouseRequest::where('status', 'new')->count(),
                'in_progress_requests' => HouseRequest::where('status', 'in_progress')->count(),
                'completed_requests' => HouseRequest::where('status', 'completed')->count(),
                'cancelled_requests' => HouseRequest::where('status', 'cancelled')->count(),
                'total_feedback' => Feedback::count(),
                'recent_requests' => HouseRequest::with(['houseType', 'floor', 'roof', 'material', 'foundation', 'facade', 'electrical', 'wallFinish'])
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
                'recent_feedback' => Feedback::orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get()
            ];
            
            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка загрузки статистики: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Обновить статус заявки
     */
    public function updateRequestStatus(Request $request, $id)
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $validated = $request->validate([
                'status' => 'required|string|in:new,in_progress,completed,cancelled',
            ]);

            $houseRequest = HouseRequest::findOrFail($id);
            $houseRequest->status = $validated['status'];
            $houseRequest->save();

            return response()->json([
                'success' => true,
                'message' => 'Статус заявки успешно обновлен'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка обновления статуса: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Создать новую запись
     */
    public function store(Request $request, $table)
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electricals', 'wall_finishes', 'additions'];
        
        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Недопустимая таблица'], 400);
        }

        try {
            $data = $request->all();
            $data['created_at'] = now();
            $data['updated_at'] = now();
            
            // Убираем _token и другие служебные поля
            unset($data['_token']);
            
            $id = DB::table($table)->insertGetId($data);
            
            return response()->json([
                'success' => true, 
                'message' => 'Запись успешно создана',
                'id' => $id
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка создания записи: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Обновить запись
     */
    public function update(Request $request, $table, $id)
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electricals', 'wall_finishes', 'additions'];
        
        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Недопустимая таблица'], 400);
        }

        try {
            $data = $request->all();
            $data['updated_at'] = now();
            
            // Убираем служебные поля
            unset($data['_token'], $data['_method']);
            
            DB::table($table)->where('id', $id)->update($data);
            
            return response()->json([
                'success' => true, 
                'message' => 'Запись успешно обновлена'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка обновления записи: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Удалить запись
     */
    public function destroy($table, $id)
    {
        if (!Session::get('admin_authenticated', false)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electricals', 'wall_finishes', 'additions', 'requests', 'feedback'];
        
        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Недопустимая таблица'], 400);
        }

        try {
            if ($table === 'requests') {
                HouseRequest::findOrFail($id)->delete();
            } elseif ($table === 'feedback') {
                Feedback::findOrFail($id)->delete();
            } else {
                DB::table($table)->where('id', $id)->delete();
            }
            
            return response()->json([
                'success' => true, 
                'message' => 'Запись успешно удалена'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка удаления записи: ' . $e->getMessage()], 500);
        }
    }
}
