@extends('layouts.app')

@section('content')
<div class="main-container books-container">
    <h1 class="page-title">Издательства</h1>

    <div class="actions-bar">
        <a href="{{ route('items.publishings.create') }}" class="btn btn-primary">Добавить издательство</a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publishings as $publishing)
                    <tr>
                        <td>{{ $publishing->name }}</td>
                        <td class="table-actions">
                            <a href="{{ route('items.publishings.edit', $publishing) }}" class="btn btn-secondary btn-small">Редактировать</a>
                            <form action="{{ route('items.publishings.destroy', $publishing) }}" method="POST" class="inline-form" onsubmit="return confirm('Удалить это издательство?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-small">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <p>&copy; {{ date('Y') }} Библиотечный медиацентр НТТЭК</p>
    </div>
</footer>
@endsection
