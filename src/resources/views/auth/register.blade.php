@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
    <form action="/register" class="register-form" method="post" novalidate>
        @csrf
        <p class="title">会員登録</p>
        <div>
            <label class="input-item" for="name">ユーザー名</label>
            <input type="text" name="name" id="name" class="input" value="{{ old('name') }}">
            @error('name')
            <p class="error">{{ $errors -> first('name') }}</p>
            @enderror
        </div>
        <div>
            <label class="input-item" for="email">メールアドレス</label>
            <input type="email" name="email" id="email"  class="input" value="{{ old('email') }}">
            @error('email')
            <p class="error">{{ $errors -> first('email') }}</p>
            @enderror
        </div>
        <div>
            <label class="input-item" for="password">パスワード</label>
            <input type="password" name="password" id="password" class="input">
            @error('password')
            <p class="error">{{ $errors -> first('password') }}</p>
            @enderror
        </div>
        <div>
            <label class="input-item" for="password-confirmation">確認用パスワード</label>
            <input type="password" name="password_confirmation" id="password-confirmation"  class="input">
            @error('password-confirmation')
            <p class="error">{{ $errors -> first('password_confirmation') }}</p>
            @enderror
        </div>
        <button class="register-button">登録する</button>
    </form>
    <form action="/login" method="get" class="login-form">
        <button class="login-button">ログインはこちら</button>
    </form>
</div>
@endsection
