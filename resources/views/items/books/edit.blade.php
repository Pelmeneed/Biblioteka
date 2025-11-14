@extends('layouts.app')

@section('content')
<div class="main-container form-page">
    <div class="form-card">
        <h1 class="page-title">Редактирование книги</h1>

        <form action="{{ route('items.books.update', $book) }}" method="POST" class="book-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="fullname" class="form-label">Название:</label>
                <input type="text" name="fullname" id="fullname" value="{{ $book->fullname }}" required maxlength="255" class="form-control">
            </div>

            <div class="form-group">
                <label for="type_of_book_id" class="form-label">Тип книги:</label>
                <select name="type_of_book_id" id="type_of_book_id" required class="form-control">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $book->type_of_book_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="author_id" class="form-label">Автор:</label>
                <select name="author_id" id="author_id" required class="form-control">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                            {{ $author->lastname }} {{ $author->firstname }} {{ $author->patronymic }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="publishing_id" class="form-label">Издательство:</label>
                <select name="publishing_id" id="publishing_id" required class="form-control">
                    @foreach($publishings as $publishing)
                        <option value="{{ $publishing->id }}" {{ $book->publishing_id == $publishing->id ? 'selected' : '' }}>
                            {{ $publishing->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="year_of_publish" class="form-label">Год издания:</label>
                <input type="number" name="year_of_publish" id="year_of_publish" value="{{ $book->year_of_publish }}" required min="1900" max="{{ date('Y') }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="count_of_sheets" class="form-label">Количество страниц:</label>
                <input type="number" name="count_of_sheets" id="count_of_sheets" value="{{ $book->count_of_sheets }}" required min="1" class="form-control">
            </div>

            <div class="form-group">
                <label for="count_of_items" class="form-label">Количество экземпляров:</label>
                <input type="number" name="count_of_items" id="count_of_items" value="{{ $book->count_of_items }}" required min="1" class="form-control">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="{{ route('items.books.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
        </div>
    </footer>
</div>
@endsection
