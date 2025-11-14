@extends('layouts.app')

@section('content')
<div class="issuance-form">
    <h1>Выдача книг</h1>

    <form action="{{ route('accounting.issuance.store') }}" method="POST">
        @csrf

        <div class="issuance-group">
            <label for="reader_id">Читатель:</label>
            <select name="reader_id" id="reader_id" required>
                <option value="">Выберите читателя</option>
                @foreach($readers as $reader)
                    <option value="{{ $reader->id }}">
                        {{ $reader->lastname }} {{ $reader->firstname }} {{ $reader->patronymic }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="books-section" id="books_section">
            <h3>Выбираемые книги:</h3>
            <div class="book-row">
                <select name="book_ids[]" class="book-select" required>
                    <option value="">Выберите книгу</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" data-available="{{ $book->available_count }}">
                            {{ $book->fullname }} (Доступно: {{ $book->available_count }})
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn-issuance btn-issuance-danger" onclick="removeBookRow(this)">Удалить</button>
            </div>
        </div>

        <button type="button" class="btn-add-book" onclick="addBookRow()">Добавить еще книгу</button>

        <div class="issuance-actions">
            <button type="submit" class="btn-issuance btn-issuance-primary">Выдать книги</button>
            <a href="{{ route('home') }}" class="btn-issuance btn-issuance-secondary">Отмена</a>
        </div>
    </form>
</div>

<footer class="footer">
    <div class="footer-container">
        <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
    </div>
</footer>

<script>
function addBookRow() {
    const booksSection = document.getElementById('books_section');
    const newRow = document.createElement('div');
    newRow.className = 'book-row';
    newRow.innerHTML = `
        <select name="book_ids[]" class="book-select" required>
            <option value="">Выберите книгу</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}" data-available="{{ $book->available_count }}">
                    {{ $book->fullname }} (Доступно: {{ $book->available_count }})
                </option>
            @endforeach
        </select>
        <button type="button" class="btn-issuance btn-issuance-danger" onclick="removeBookRow(this)">Удалить</button>
    `;
    booksSection.appendChild(newRow);
}

function removeBookRow(button) {
    const rows = document.querySelectorAll('.book-row');
    if (rows.length > 1) {
        button.parentElement.remove();
    }
}
</script>
@endsection
