<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Request as HouseRequest;
use App\Models\Feedback;

class CreateTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:create-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание тестовых заявок и обращений';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Создание тестовых данных...');

        // Создаем тестовые заявки
        $testRequests = [
            [
                'house_type_id' => 1,
                'area' => 120.5,
                'floor_id' => 1,
                'roof_id' => 1,
                'material_id' => 1,
                'foundation_id' => 1,
                'facade_id' => 1,
                'electrical_id' => 1,
                'wall_finish_id' => 1,
                'additions' => [1, 2],
                'name' => 'Иван Петров',
                'phone' => '+7(999)123-45-67',
                'email' => 'ivan@example.com',
                'comment' => 'Хочу построить дом для семьи из 4 человек',
                'total_price' => 2500000,
                'status' => 'new'
            ],
            [
                'house_type_id' => 2,
                'area' => 85.0,
                'floor_id' => 2,
                'roof_id' => 2,
                'material_id' => 2,
                'foundation_id' => 2,
                'facade_id' => 2,
                'electrical_id' => 2,
                'wall_finish_id' => 2,
                'additions' => [3],
                'name' => 'Мария Сидорова',
                'phone' => '+7(999)987-65-43',
                'email' => 'maria@example.com',
                'comment' => 'Интересует дачный дом',
                'total_price' => 1800000,
                'status' => 'in_progress'
            ],
            [
                'house_type_id' => 3,
                'area' => 200.0,
                'floor_id' => 1,
                'roof_id' => 3,
                'material_id' => 3,
                'foundation_id' => 3,
                'facade_id' => 3,
                'electrical_id' => 3,
                'wall_finish_id' => 3,
                'additions' => [1, 2, 3, 4],
                'name' => 'Александр Козлов',
                'phone' => '+7(999)555-44-33',
                'email' => 'alex@example.com',
                'comment' => 'Нужен большой дом с гаражом и террасой',
                'total_price' => 4500000,
                'status' => 'completed'
            ]
        ];

        // Создаем тестовые обращения
        $testFeedback = [
            [
                'firstname' => 'Анна Иванова',
                'tel' => '+7(999)111-22-33',
                'email' => 'anna@example.com',
                'subject' => 'Интересует строительство дома под ключ'
            ],
            [
                'firstname' => 'Дмитрий Волков',
                'tel' => '+7(999)444-55-66',
                'email' => 'dmitry@example.com',
                'subject' => 'Нужна консультация по выбору материалов'
            ],
            [
                'firstname' => 'Елена Смирнова',
                'tel' => '+7(999)777-88-99',
                'email' => 'elena@example.com',
                'subject' => 'Хочу узнать стоимость проекта'
            ]
        ];

        try {
            // Создаем заявки
            foreach ($testRequests as $requestData) {
                $request = HouseRequest::create($requestData);
                $this->info("Создана заявка ID: {$request->id} для {$request->name}");
            }

            // Создаем обращения
            foreach ($testFeedback as $feedbackData) {
                $feedback = Feedback::create($feedbackData);
                $this->info("Создано обращение ID: {$feedback->id} от {$feedback->firstname}");
            }

            $this->info("\nТестовые данные успешно созданы!");

            // Показываем статистику
            $this->info("\nСтатистика:");
            $this->info("Всего заявок: " . HouseRequest::count());
            $this->info("Новых заявок: " . HouseRequest::where('status', 'new')->count());
            $this->info("Заявок в работе: " . HouseRequest::where('status', 'in_progress')->count());
            $this->info("Завершенных заявок: " . HouseRequest::where('status', 'completed')->count());
            $this->info("Всего обращений: " . Feedback::count());

        } catch (\Exception $e) {
            $this->error("Ошибка: " . $e->getMessage());
        }
    }
} 