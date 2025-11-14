@extends('layouts.app')

@section('content')
<div class="main-container books-container">
    <h1 class="page-title">Книги</h1>

    <div class="actions-bar">
        <a href="{{ route('items.books.create') }}" class="btn btn-primary">Добавить книгу</a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Издательство</th>
                    <th>Тип</th>
                    <th>Год</th>
                    <th>Кол-во</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->fullname }}</td>
                    <td>{{ $book->author->lastname }} {{ $book->author->firstname }} {{ $book->author->patronymic }}</td>
                    <td>{{ $book->publishing->name }}</td>
                    <td>{{ $book->typeOfBook->name }}</td>
                    <td>{{ $book->year_of_publish }}</td>
                    <td>{{ $book->count_of_items }}</td>
                    <td class="table-actions">
                        <a href="{{ route('items.books.edit', $book) }}" class="btn btn-small btn-secondary">Редактировать</a>
                        <form action="{{ route('items.books.destroy', $book) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
        </div>
    </footer>
</div>
@endsection
