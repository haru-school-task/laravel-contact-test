<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Authentication</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <header class="auth-header">
        <div class="header-inner">
            <h1 class="logo">FashionablyLate</h1>
            @yield('header-link')
        </div>
    </header>
    <main class="auth-main">
        @yield('content')
    </main>
</body>

</html>