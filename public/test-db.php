<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Facade;
use App\Models\Electrical;
use App\Models\WallFinish;
use App\Models\Addition;
use App\Models\Material;

try {
    echo "Testing database connection...\n";
    
    // Проверяем подключение к БД
    $connection = DB::connection()->getPdo();
    echo "Database connected successfully: " . DB::connection()->getDatabaseName() . "\n\n";
    
    // Проверяем создание записи в таблице Electrical
    echo "Creating test record in Electrical table...\n";
    $electrical = Electrical::create([
        'name' => 'Test Electrical ' . date('Y-m-d H:i:s'),
        'description' => 'Test description',
        'price' => 1000,
        'sockets' => 5,
        'switches' => 3,
        'lights' => 7,
        'image' => 'test.jpg'
    ]);
    echo "Created Electrical record with ID: " . $electrical->id . "\n\n";
    
    // Проверяем создание записи в таблице Facade
    echo "Creating test record in Facade table...\n";
    $facade = Facade::create([
        'name' => 'Test Facade ' . date('Y-m-d H:i:s'),
        'description' => 'Test description',
        'price' => 2000,
        'image' => 'test.jpg'
    ]);
    echo "Created Facade record with ID: " . $facade->id . "\n\n";
    
    // Проверяем создание записи в таблице WallFinish
    echo "Creating test record in WallFinish table...\n";
    $wallFinish = WallFinish::create([
        'name' => 'Test WallFinish ' . date('Y-m-d H:i:s'),
        'description' => 'Test description',
        'price' => 3000,
        'image' => 'test.jpg'
    ]);
    echo "Created WallFinish record with ID: " . $wallFinish->id . "\n\n";
    
    // Проверяем создание записи в таблице Addition
    echo "Creating test record in Addition table...\n";
    $addition = Addition::create([
        'name' => 'Test Addition ' . date('Y-m-d H:i:s'),
        'description' => 'Test description',
        'price' => 4000,
        'category' => 'design',
        'image' => 'test.jpg'
    ]);
    echo "Created Addition record with ID: " . $addition->id . "\n\n";
    
    // Проверяем чтение записей
    echo "Reading records from all tables...\n";
    echo "Electrical count: " . Electrical::count() . "\n";
    echo "Facade count: " . Facade::count() . "\n";
    echo "WallFinish count: " . WallFinish::count() . "\n";
    echo "Addition count: " . Addition::count() . "\n";
    
    echo "\nTest completed successfully!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Trace: \n" . $e->getTraceAsString() . "\n";
} 