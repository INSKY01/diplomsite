@extends('layouts.app')

@section('content')
    <h1>Редактировать тип</h1>
    <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
        @csrf
        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" value="{{ $type->name }}" required>
        </div>
        <div>
            <label for="value">Значение:</label>
            <input type="number" id="value" name="value" value="{{ $type->value }}" required>
        </div>
        <input type="submit" value="Сохранить">
    </form>
@endsection 