@extends('layouts.app')

@section('content')
    <h1 class="main-title">Главный экран - Библиотечный медиацентр</h1>

    <div class="stats">
        <h2 class="section-title">Общая статистика</h2>
        <ul class="stats-list">
            <li>Всего книг в библиотеке: {{ $totalBooks }}</li>
            <li>Выдано книг: {{ $issuedBooks }}</li>
            <li>Доступно книг: {{ $availableBooks }}</li>
        </ul>
    </div>

    <div class="monthly-stats">
        <h2 class="section-title">Статистика за последние 3 месяца</h2>
        @if($monthlyStats->count() > 0)
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>Месяц/Год</th>
                        <th>Выдано книг</th>
                        <th>Не возвращено</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyStats as $stat)
                    <tr>
                        <td>{{ $stat->month }}/{{ $stat->year }}</td>
                        <td>{{ $stat->issued_count }}</td>
                        <td>{{ $stat->not_returned_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Нет данных за последние 3 месяца</p>
        @endif
    </div>

    <div class="quick-links">
        <h2 class="section-title">Быстрые ссылки</h2>
        <ul class="quick-links-list">
            <li><a href="{{ route('items.books.index') }}">Управление книгами</a></li>
            <li><a href="{{ route('items.authors.index') }}">Управление авторами</a></li>
            <li><a href="{{ route('readers.readers.index') }}">Управление читателями</a></li>
            <li><a href="{{ route('accounting.issuance.index') }}">Выдача книг</a></li>
            <li><a href="{{ route('accounting.return.index') }}">Возврат книг</a></li>
        </ul>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
        </div>
    </footer>
@endsection
