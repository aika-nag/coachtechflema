@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
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
<form action="/mypage" class="mypage">
  <button class="mypage_button">マイページ</button>
</form>
<form action="/sell" class="sell">
  <button class="sell_button">出品</button>
</form>
@endsection

@section('content')
<div class="content">
  <div class="order">
    <div class="item_detail">
      <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" class="image">
      <div class="name_price">
        <p class="item_name">{{ $item->name }}</p>
        <p class="item_price">{{ number_format($item->price)}}</p>
      </div>
    </div>
    <div class="payment">
      <p class="payment_method">支払方法</p>
      <select name="payment" class="payment_select">
        <option value="" hidden>選択してください</option>
        <option value="1">コンビニ払い</option>
        <option value="2">カード払い</option>
      </select>
      @error('payment')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>
    <div class="shipping">
      <div class="shipping_address">
        <p class="address">配送先</p>
    <form action="/purchase/address/{{{ $item->id }}}" class="change" method="get">
      <button class="change_address">変更する</button>
    </form>
  </div>
    <div class="profile">
      <input type="hidden" class="zipcode" id="zipcode" value="{{ $profile['zipcode'] }}">{{ $profile['zipcode'] }}<br />
      <input type="hidden" class="profile_address" id="address" value="{{ $profile['address']}}">{{ $profile['address']}}
      <input type="hidden" class="profile_address" id="building" value="{{ $profile['building'] }}">{{ $profile['building'] }}
    </div>
  </div>
</div>
  <div class="confirm">
    <table class="payment_detail">
      <tr>
        <th class="confirm_price">商品代金</th>
          <td class="price_info">{{ number_format($item->price)}}</td>
      </tr>
      <tr>
        <th class="confirm_payment">支払い方法</th>
          <td class="method_info" id="method_info"></td>
      </tr>
    </table>
    <form action="/purchase/{{{ $item->id }}}" method="post">
      @csrf
      <button class="purchase_button">購入する</button>
          <input type="hidden" id="hidden_select" value="" name="hidden_payment">
          <input type="hidden" id="hidden_zipcode" name="hidden_zipcode" value="">
          <input type="hidden" id="hidden_address" name="hidden_address" value="">
          <input type="hidden" id="hidden_building" name="hidden_building"  value="">
    </form>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection
