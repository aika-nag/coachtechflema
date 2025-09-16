@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<form action="/register" class="register__form" method="post">
    @csrf
<div class="content">
    <p class="title">会員登録</p>
    <div class="input">
        <label class="input_item" for="name">ユーザー名</label>
        <input type="text" name="name" id="name">
        @error('name')
        <p>{{ $errors -> first('name') }}</p>
        @enderror
    </div>
    <div class="input">
        <label class="input_item" for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
        @error('email')
        <p>{{ $errors -> first('email') }}</p>
        @enderror
    </div>
    <div class="input">
        <label class="input_item" for="password">パスワード</label>
        <input type="password" name="password" id="password">
        @error('password')
        <p>{{ $errors -> first('password') }}</p>
        @enderror
    </div>
    <div class="input">
        <label class="input_item" for="password_confirmation">確認用パスワード</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        @error('password_confirmation')
        <p>{{ $errors -> first('password_confirmation') }}</p>
        @enderror
    </div>

        <button class="register_button">登録する</button>
</form>
    <form action="/login" method="get" class="login__form">
        @csrf
        <button class="login_button">ログインはこちら</button>
    </form>
</div>
@endsection
