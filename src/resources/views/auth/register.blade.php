@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
  <form action="/register" class="register__form" method="post" novalidate>
    @csrf
    <p class="title">会員登録</p>
    <div>
    <label class="input_item" for="name">ユーザー名</label>
    <input type="text" name="name" id="name" class="input" value="{{ old('name') }}">
    @error('name')
    <p class="error">{{ $errors -> first('name') }}</p>
    @enderror
    </div>
    <div>
      <label class="input_item" for="email">メールアドレス</label>
      <input type="email" name="email" id="email"  class="input" value="{{ old('email') }}">
      @error('email')
      <p class="error">{{ $errors -> first('email') }}</p>
      @enderror
    </div>
    <div>
      <label class="input_item" for="password">パスワード</label>
      <input type="password" name="password" id="password" class="input" value="{{ old('password') }}">
      @error('password')
      <p class="error">{{ $errors -> first('password') }}</p>
      @enderror
    </div>
    <div>
      <label class="input_item" for="password_confirmation">確認用パスワード</label>
      <input type="password" name="password_confirmation" id="password_confirmation"  class="input" value="{{ old('password_confirmation') }}">
      @error('password_confirmation')
      <p class="error">{{ $errors -> first('password_confirmation') }}</p>
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
