@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h2>Редактирование типа издания</h2>

        <form action="{{ route('items.types-of-books.update', $typesOfBook) }}" method="POST" class="form-styled">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Название типа:</label>
                <input type="text" name="name" id="name" value="{{ $typesOfBook->name }}" required maxlength="150">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="{{ route('items.types-of-books.index') }}" class="btn btn-secondary">Отмена</a>
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
