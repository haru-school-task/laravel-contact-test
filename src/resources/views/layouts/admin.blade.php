<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FashionablyLate - Admin Dashboard</title>

    <!-- リセットCSS -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    <!-- 管理画面共通CSS (hoverやテーブル、モーダルの設定が入っているもの) -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- 各ページ固有のCSS（もしあれば） -->
    @yield('css')
</head>

<body>
    <main>
        {{-- admin/index.blade.php の中身がここに表示される --}}
        @yield('content')
    </main>

    <!-- 管理画面用JavaScript (モーダル制御用) -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>