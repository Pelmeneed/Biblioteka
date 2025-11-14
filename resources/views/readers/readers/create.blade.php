@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h2>Добавление читателя</h2>

        <form action="{{ route('readers.readers.store') }}" method="POST" class="form-styled">
            @csrf

            <div class="form-group">
                <label for="lastname">Фамилия:</label>
                <input type="text" name="lastname" id="lastname" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="firstname">Имя:</label>
                <input type="text" name="firstname" id="firstname" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="patronymic">Отчество:</label>
                <input type="text" name="patronymic" id="patronymic" maxlength="100">
            </div>

            <div class="form-group">
                <label for="type_of_reader">Тип читателя:</label>
                <select name="type_of_reader" id="type_of_reader" required>
                    <option value="">Выберите тип</option>
                    <option value="teacher">Преподаватель</option>
                    <option value="student">Студент</option>
                    <option value="other">Другое</option>
                </select>
            </div>

            <div id="group_field" class="form-group" style="display: none;">
                <label for="group_id">Группа:</label>
                <select name="group_id" id="group_id">
                    <option value="">Выберите группу</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="can_get_books" value="1" checked>
                    Может получать книги
                </label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('readers.readers.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
        </div>
    </footer>
</div>

<script>
document.getElementById('type_of_reader').addEventListener('change', function() {
    const groupField = document.getElementById('group_field');
    const groupSelect = document.getElementById('group_id');
    if (this.value === 'student') {
        groupField.style.display = 'block';
        groupSelect.setAttribute('required', 'required');
    } else {
        groupField.style.display = 'none';
        groupSelect.removeAttribute('required');
        groupSelect.value = '';
    }
});
</script>
@endsection
