@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Типы изданий</h1>

    <div class="actions-bar">
        <a href="{{ route('items.types-of-books.create') }}" class="btn btn-primary">Добавить тип</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Название</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td class="table-actions">
                    <a href="{{ route('items.types-of-books.edit', $type) }}" class="btn btn-secondary btn-small">Редактировать</a>
                    <form action="{{ route('items.types-of-books.destroy', $type) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Удалить этот тип?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
        </div>
    </footer>
</div>
@endsection
