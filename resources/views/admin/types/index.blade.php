@extends('layouts.app')

@section('content')
    <h1>Типы</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Значение</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->value }}</td>
                    <td>
                        <a href="{{ route('admin.types.edit', $type->id) }}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 