<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Библиотечный медиацентр НТТЭК</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="body">

    <header class="header">
        <div class="header-container">
            <a href="{{ route('home') }}" class="site-title">
                <img src="{{ asset('img/nttek_logo.png') }}" alt="">
            </a>
            <nav class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link">Главная</a>
                <a href="{{ route('items.books.index') }}" class="nav-link">Книги</a>
                <a href="{{ route('items.authors.index') }}" class="nav-link">Авторы</a>
                <a href="{{ route('items.publishings.index') }}" class="nav-link">Издательства</a>
                <a href="{{ route('items.types-of-books.index') }}" class="nav-link">Типы книг</a>
                <a href="{{ route('readers.groups.index') }}" class="nav-link">Группы</a>
                <a href="{{ route('readers.readers.index') }}" class="nav-link">Читатели</a>
                <a href="{{ route('accounting.issuance.index') }}" class="nav-link">Выдача</a>
                <a href="{{ route('accounting.return.index') }}" class="nav-link">Возврат</a>
            </nav>
        </div>
    </header>

    <main class="main-container">
        @yield('content')
    </main>


</body>
</html>
