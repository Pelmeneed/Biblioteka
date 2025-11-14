@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Читатели</h1>

    <div class="actions-bar">
        <a href="{{ route('readers.readers.create') }}" class="btn btn-primary">Добавить читателя</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>ФИО</th>
                <th>Тип читателя</th>
                <th>Группа</th>
                <th>Может получать книги</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($readers as $reader)
            <tr>
                <td>{{ $reader->lastname }} {{ $reader->firstname }} {{ $reader->patronymic }}</td>
                <td>
                    @if($reader->type_of_reader == 'teacher')
                        Преподаватель
                    @elseif($reader->type_of_reader == 'student')
                        Студент
                    @else
                        Другое
                    @endif
                </td>
                <td>{{ $reader->group ? $reader->group->name : '-' }}</td>
                <td>{{ $reader->can_get_books ? 'Да' : 'Нет' }}</td>
                <td class="table-actions">
                    <a href="{{ route('readers.readers.edit', $reader) }}" class="btn btn-secondary btn-small">Редактировать</a>
                    <form action="{{ route('readers.readers.destroy', $reader) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Удалить этого читателя?')">Удалить</button>
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
