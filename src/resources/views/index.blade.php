@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  <div class="content">
    <p class="title">ログイン</p>
    <div class="input">
      <p class="login_item">メールアドレス</p>
      <input type="email" name="email">
    </div>
    <div class="input">
      <p class="login_item">パスワード</p>
      <input type="password" name="password">
    </div>
    <form action="" class="login__form"><button class="login_button">ログインする</button></form>
    <form action="" class="register__form">
    <button class="register_button">会員登録はこちら</button>
    </form>
  </div>
@endsection
