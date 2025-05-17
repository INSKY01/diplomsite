<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать этаж</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Редактировать этаж</h1>
        <form action="{{ route('floors.update', $floor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" id="name" name="name" value="{{ $floor->name }}" required>
            </div>
            <div class="form-group">
                <label for="multiplier">Множитель:</label>
                <input type="number" step="0.1" id="multiplier" name="multiplier" value="{{ $floor->multiplier }}" required>
            </div>
            <div class="form-group">
                <label for="image">URL изображения:</label>
                <input type="text" id="image" name="image" value="{{ $floor->image }}">
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea id="description" name="description">{{ $floor->description }}</textarea>
            </div>
            <button type="submit">Сохранить</button>
        </form>
        <a href="{{ route('floors.index') }}">Назад</a>
    </div>
</body>
</html> 