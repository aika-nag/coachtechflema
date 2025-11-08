@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
  <div class="content">
    <p class="title">ログイン</p>
    <form action="/login" class="login__form" method="post" novalidate>
      @csrf
      <div class="input">
        <label class="login_item" for="email">メールアドレス</label>
        <input type="email" name="email" id="email">
        @error('email')
        <p class="error">{{ $message }}</p>
        @enderror
      </div>
      <div class="input">
        <label class="login_item" for="password">パスワード</label>
        <input type="password" name="password" id="password">
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror
      </div>
      <button class="login_button">ログインする</button>
    </form>
    <form action="/register" method="get" class="register__form">
      @csrf
      <button class="register_button">会員登録はこちら</button>
    </form>
  </div>
@endsection
