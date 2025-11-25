@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
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
        @csrf
        <button class="register-button">会員登録はこちら</button>
    </form>
</div>
@endsection
