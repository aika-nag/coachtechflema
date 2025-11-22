@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('input_bar')
<form action="/item/find" method="post">
  @csrf
  <input type="text" class="search" name="search" placeholder="なにをお探しですか？" value="{{ old('search') }}">
</form>
@endsection

@section('nav')
<form action="/logout" class="logout" method="post">
  @csrf
  <button class="logout_button">ログアウト</button>
</form>
<form action="" class="mypage">
  <button class="mypage_button">マイページ</button>
</form>
<form action="" class="sell">
  <button class="sell_button">出品</button>
</form>
@endsection

@section('content')
<div class="content">
  <form action="/purchase/deliveryaddress/{{{ $item->id }}}" class="profile__form" method="get">
    <p class="title">住所の変更</p>
    <div class="input">
    <label class="input_item" for="zipcode">郵便番号</label>
    <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}">
    @error('zipcode')
    <p class="error">{{ $errors -> first('zipcode') }}</p>
    @enderror
    </div>
    <div class="input">
      <label class="input_item" for="address">住所</label>
      <input type="text" name="address" id="address" value="{{ old('address') }}">
      @error('address')
      <p class="error">{{ $errors -> first('address') }}</p>
      @enderror
    </div>
    <div class="input">
      <label class="input_item" for="building">建物名</label>
      <input type="text" name="building" id="building" value="{{ old('building') }}">
      @error('building')
      <p class="error">{{ $errors -> first('building') }}</p>
      @enderror
    </div>
    <input type="hidden" name="payment" value="{{ $payment}}">
      <button class="change_address_button">更新する</button>
  </form>
</div>
@endsection
