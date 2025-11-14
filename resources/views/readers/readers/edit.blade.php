@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h2>Редактирование читателя</h2>

        <form action="{{ route('readers.readers.update', $reader) }}" method="POST" class="form-styled">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="lastname">Фамилия:</label>
                <input type="text" name="lastname" id="lastname" value="{{ $reader->lastname }}" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="firstname">Имя:</label>
                <input type="text" name="firstname" id="firstname" value="{{ $reader->firstname }}" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="patronymic">Отчество:</label>
                <input type="text" name="patronymic" id="patronymic" value="{{ $reader->patronymic }}" maxlength="100">
            </div>

            <div class="form-group">
                <label for="type_of_reader">Тип читателя:</label>
                <select name="type_of_reader" id="type_of_reader" required>
                    <option value="teacher" {{ $reader->type_of_reader == 'teacher' ? 'selected' : '' }}>Преподаватель</option>
                    <option value="student" {{ $reader->type_of_reader == 'student' ? 'selected' : '' }}>Студент</option>
                    <option value="other" {{ $reader->type_of_reader == 'other' ? 'selected' : '' }}>Другое</option>
                </select>
            </div>

            <div id="group_field" class="form-group" style="{{ $reader->type_of_reader == 'student' ? 'display: block;' : 'display: none;' }}">
                <label for="group_id">Группа:</label>
                <select name="group_id" id="group_id" {{ $reader->type_of_reader == 'student' ? 'required' : '' }}>
                    <option value="">Выберите группу</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ $reader->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="can_get_books" value="1" {{ $reader->can_get_books ? 'checked' : '' }}>
                    Может получать книги
                </label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Обновить</button>
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
