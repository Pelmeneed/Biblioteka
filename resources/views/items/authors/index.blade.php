@extends('layouts.app')

@section('content')
<div class="main-container books-container">
    <h1 class="page-title">Авторы</h1>

    <div class="actions-bar">
        <a href="{{ route('items.authors.create') }}" class="btn btn-primary">Добавить автора</a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->lastname }} {{ $author->firstname }} {{ $author->patronymic }}</td>
                        <td class="table-actions">
                            <a href="{{ route('items.authors.edit', $author) }}" class="btn btn-secondary btn-small">Редактировать</a>
                            <form action="{{ route('items.authors.destroy', $author) }}" method="POST" class="inline-form" onsubmit="return confirm('Удалить этого автора?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-small">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
    </div>
</footer>
@endsection
