@extends('layouts.app')

@section('content')
<div class="return-page">
    <h1>Возврат книг</h1>

    @if($issuedBooks->count() > 0)
        <form action="{{ route('accounting.return.multiple') }}" method="POST" id="returnForm">
            @csrf

            <div class="table-container">
                <table class="return-table">
                    <thead>
                        <tr>
                            <th>✓</th>
                            <th>ID выдачи</th>
                            <th>Книга</th>
                            <th>Читатель</th>
                            <th>Дата выдачи</th>
                            <th>Количество</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($issuedBooks as $issue)
                        <tr>
                            <td>
                                <input type="checkbox" name="book_actions[]" value="{{ $issue->id }}" class="book-checkbox">
                            </td>
                            <td>{{ $issue->id }}</td>
                            <td>
                                <strong>{{ $issue->book->fullname }}</strong><br>
                                <small>Автор: {{ $issue->book->author->lastname }} {{ $issue->book->author->firstname }}</small>
                            </td>
                            <td>
                                <strong>{{ $issue->reader->lastname }} {{ $issue->reader->firstname }} {{ $issue->reader->patronymic }}</strong><br>
                                <small>
                                    @if($issue->reader->type_of_reader == 'teacher')
                                        Преподаватель
                                    @elseif($issue->reader->type_of_reader == 'student')
                                        Студент ({{ $issue->reader->group->name ?? 'Без группы' }})
                                    @else
                                        Другое
                                    @endif
                                </small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($issue->get_date)->format('d.m.Y') }}</td>
                            <td>{{ $issue->count }} шт.</td>
                            <td>
                                <form action="{{ route('accounting.return.return-by-id', $issue) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-return btn-danger">Вернуть</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="return-actions">
                <button type="button" class="btn-return btn-secondary" onclick="selectAll()">Выбрать все</button>
                <button type="button" class="btn-return btn-secondary" onclick="deselectAll()">Снять выделение</button>
                <button type="submit" id="returnSelected" class="btn-return btn-primary" disabled>Вернуть выбранные книги</button>
            </div>
        </form>
    @else
        <p class="empty-text">Нет выданных книг для возврата</p>
    @endif
</div>

<footer class="footer">
    <div class="footer-container">
        <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
    </div>
</footer>

<script>
document.querySelectorAll('.book-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateReturnButton);
});

function updateReturnButton() {
    const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
    document.getElementById('returnSelected').disabled = checkedBoxes.length === 0;
}

function selectAll() {
    document.querySelectorAll('.book-checkbox').forEach(cb => cb.checked = true);
    updateReturnButton();
}

function deselectAll() {
    document.querySelectorAll('.book-checkbox').forEach(cb => cb.checked = false);
    updateReturnButton();
}

document.getElementById('returnForm').addEventListener('submit', function(e) {
    const count = document.querySelectorAll('.book-checkbox:checked').length;
    if (count > 0 && !confirm(`Вы уверены, что хотите вернуть ${count} книг(и)?`)) {
        e.preventDefault();
    }
});
</script>
@endsection
