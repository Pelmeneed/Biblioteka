@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="form-card">
        <h1 class="page-title">Редактирование издательства</h1>

        <form action="{{ route('items.publishings.update', $publishing) }}" method="POST" class="book-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Название издательства:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $publishing->name }}" required maxlength="150">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="{{ route('items.publishings.index') }}" class="btn btn-secondary">Отмена</a>
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
