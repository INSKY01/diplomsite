<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class TestMail extends Command
{
    protected $signature = 'test:mail';
    protected $description = 'Test email sending';

    public function handle()
    {
        try {
            $testData = [
                'firstname' => 'Тестовый пользователь',
                'tel' => '+7 920 123-45-67',
                'email' => 'test@example.com',
                'subject' => 'Тестовое сообщение для проверки отправки писем'
            ];

            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new FeedbackMail($testData));
            
            $this->info('Тестовое письмо успешно отправлено на ' . env('MAIL_FROM_ADDRESS'));
            
        } catch (\Exception $e) {
            $this->error('Ошибка при отправке письма: ' . $e->getMessage());
        }
    }
} 