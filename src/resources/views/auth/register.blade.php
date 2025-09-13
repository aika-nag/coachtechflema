@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
    <p class="title">会員登録</p>
    <div class="input">
        <label class="input_item" for="name">ユーザー名</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="input">
        <label class="input_item" for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
    </div>
    <div class="input">
        <label class="input_item" for="password">パスワード</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="input">
        <label class="input_item" for="password_confirmation">確認用パスワード</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    <form action="" class="register__form">
        <button class="register_button">登録する</button>
    </form>
    <form action="/login" method="get" class="login__form">
        @csrf
        <button class="login_button">ログインはこちら</button>
    </form>
</div>
@endsection
