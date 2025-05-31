<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Аутентификация в админ-панель
     */
    public function login(Request $request)
    {
        $password = $request->input('password');
        $correctPassword = env('ADMIN_PASSWORD', 'Respons1');
        
        if ($password === $correctPassword) {
            Session::put('admin_authenticated', true);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Неверный пароль'], 401);
    }
    
    /**
     * Проверка аутентификации
     */
    public function checkAuth()
    {
        $authenticated = Session::get('admin_authenticated', false);
        return response()->json(['authenticated' => $authenticated]);
    }
    
    /**
     * Выход из админ-панели
     */
    public function logout()
    {
        Session::forget('admin_authenticated');
        return response()->json(['success' => true]);
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
                'electrical' => DB::table('electrical')->get(),
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

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electrical', 'wall_finishes', 'additions'];
        
        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Недопустимая таблица'], 400);
        }

        try {
            $data = DB::table($table)->get();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка загрузки данных: ' . $e->getMessage()], 500);
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

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electrical', 'wall_finishes', 'additions'];
        
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

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electrical', 'wall_finishes', 'additions'];
        
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

        $allowedTables = ['house_types', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electrical', 'wall_finishes', 'additions'];
        
        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Недопустимая таблица'], 400);
        }

        try {
            DB::table($table)->where('id', $id)->delete();
            
            return response()->json([
                'success' => true, 
                'message' => 'Запись успешно удалена'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка удаления записи: ' . $e->getMessage()], 500);
        }
    }
}
