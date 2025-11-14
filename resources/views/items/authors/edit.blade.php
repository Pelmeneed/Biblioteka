@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="form-card">
        <h1 class="page-title">Редактирование автора</h1>

        <form action="{{ route('items.authors.update', $author) }}" method="POST" class="book-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="lastname" class="form-label">Фамилия:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $author->lastname }}" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="firstname" class="form-label">Имя:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $author->firstname }}" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="patronymic" class="form-label">Отчество:</label>
                <input type="text" name="patronymic" id="patronymic" class="form-control" value="{{ $author->patronymic }}" maxlength="100">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="{{ route('items.authors.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
    </div>
</footer>
@endsection
