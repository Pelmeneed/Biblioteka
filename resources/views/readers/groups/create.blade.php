@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h2>Добавление группы</h2>

        <form action="{{ route('readers.groups.store') }}" method="POST" class="form-styled">
            @csrf

            <div class="form-group">
                <label for="name">Название группы:</label>
                <input type="text" name="name" id="name" required maxlength="20">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('readers.groups.index') }}" class="btn btn-secondary">Отмена</a>
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
