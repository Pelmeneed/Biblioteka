@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Группы</h1>

    <div class="actions-bar">
        <a href="{{ route('readers.groups.create') }}" class="btn btn-primary">Добавить группу</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Название</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td class="table-actions">
                    <a href="{{ route('readers.groups.edit', $group) }}" class="btn btn-secondary btn-small">Редактировать</a>
                    <form action="{{ route('readers.groups.destroy', $group) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Удалить эту группу?')">Удалить</button>
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
