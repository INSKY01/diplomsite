<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request)
    {
        try {
            $data = $request->validate([
                'firstname' => 'required|string|max:255',
                'tel' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'subject' => 'nullable|string|max:1000',
            ]);

            // Логирование данных для отладки
            Log::info('Feedback data:', $data);

            // Сохранение данных в базе данных
            $feedback = Feedback::create($data);

            // Отправка email администратору
            try {
                Mail::to(env('MAIL_FROM_ADDRESS'))->send(new FeedbackMail($data));
                Log::info('Feedback email sent successfully', ['feedback_id' => $feedback->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send feedback email', [
                    'feedback_id' => $feedback->id,
                    'error' => $e->getMessage()
                ]);
            }

            return back()->with('success', 'Ваше сообщение отправлено и сохранено!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for feedback', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Failed to send feedback', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);
            
            return back()->with('error', 'Произошла ошибка при отправке сообщения. Попробуйте еще раз.');
        }
    }
} 