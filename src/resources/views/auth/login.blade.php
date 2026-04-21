<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フリマログイン</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <a href="/" class="logo">
                <img src="../../../../images/logo.svg" alt="coachtechロゴ" class="logo-image">
            </a>
            <button class="toggle-menu-button" id="toggle-menu-button"></button>
        </div>
    </header>
    <main>
        <div class="content">
            <p class="title">ログイン</p>
            <form action="/login" class="login-form" method="post" novalidate>
                @csrf
                <div>
                    <label class="login-item" for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" class="input-email">
                    @error('email')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="login-item" for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="input-password">
                    @error('password')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button class="login-button">ログインする</button>
            </form>
            <form action="/register" method="get" class="register-form">
                <button class="register-button">会員登録はこちら</button>
            </form>
        </div>
    </main>
</body>
</html>
