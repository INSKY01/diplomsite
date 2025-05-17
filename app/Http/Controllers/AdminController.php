<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Аутентификация в админ-панель
     */
    public function login(Request $request)
    {
        $password = $request->input('password');
        $correctPassword = env('ADMIN_PASSWORD', 'Respons1'); // Пароль из .env или по умолчанию
        
        if ($password === $correctPassword) {
            // Сохраняем в сессии флаг авторизации
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
     * Список типов домов
     */
    public function index()
    {
        // В будущем здесь будет загрузка типов домов из БД
        // Пока возвращаем пустой список
        return response()->json([]);
    }
    
    /**
     * Редактирование типа дома
     */
    public function edit($id)
    {
        // В будущем здесь будет загрузка типа дома из БД по ID
        // Пока возвращаем пустой объект
        return response()->json([]);
    }
    
    /**
     * Обновление типа дома
     */
    public function update(Request $request, $id)
    {
        // В будущем здесь будет обновление типа дома в БД
        // Пока просто возвращаем успех
        return response()->json(['success' => true]);
    }
}
