<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FashionablyLate - Contact Form</title>

    <!-- 1. ブラウザの差異をなくす -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    <!-- 2. 全ページ共通の枠組み（茶色のラベル、全体の背景など） -->
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <!-- 3. 各ページ（入力・確認・サンクス）固有のCSSを差し込む場所 -->
    @yield('css')
</head>

<body>

    <header class="header">
        <div class="header-inner">
            <h1 class="header-logo">FashionablyLate</h1>
        </div>
    </header>

    <main>
        {{-- 各View（input.blade.phpなど）の中身がここに表示される --}}
        @yield('content')
    </main>

    {{-- 必要に応じてフッターを追加 --}}
    {{-- <footer class="footer"> ... </footer> --}}

</body>

</html>