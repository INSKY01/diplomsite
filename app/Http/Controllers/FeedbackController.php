<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request)
{
    $data = $request->validate([
        'firstname' => 'required|string',
        'tel' => 'required|string',
        'email' => 'required|email',
        'subject' => 'nullable|string',
    ]);

    // Логирование данных для отладки
    \Log::info('Feedback data:', $data);

    // Сохранение данных в базе данных
    Feedback::create($data);

    return back()->with('success', 'Ваше сообщение отправлено и сохранено!');
}
} 