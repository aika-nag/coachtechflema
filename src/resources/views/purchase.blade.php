@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('search')
<form action="/item/find" method="post">
    @csrf
    <input type="text" class="keyword" name="search" placeholder="なにをお探しですか？" value="{{ old('search') }}">
</form>
@endsection

@section('nav')
<form action="/logout" class="logout" method="post">
    @csrf
    <button class="logout-button">ログアウト</button>
</form>
<form action="/mypage" class="mypage">
    <button class="mypage-button">マイページ</button>
</form>
<form action="/sell" class="sell">
    <button class="sell-button">出品</button>
</form>
@endsection

@section('content')
<div class="content">
    <div class="order">
        <div class="item-detail">
            <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" class="image">
            <div class="name-price">
                <p class="item-name">{{ $item->name }}</p>
                <p class="item-price">{{ number_format($item->price)}}</p>
            </div>
        </div>
        <div class="payment">
            <p class="payment-method">支払方法</p>
            <select name="payment" class="payment-select">
                <option value="" hidden>選択してください</option>
                <option value="1">コンビニ払い</option>
                <option value="2">カード払い</option>
            </select>
            @error('payment')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="shipping">
            <div class="shipping-address">
                <p class="address">配送先</p>
                <a href="/purchase/address/{{{ $item->id }}}" class="change-address">変更する</a>
            </div>
            <div class="profile">
                <p class="zipcode" >{{ $profile['zipcode'] }}</p>
                <p class="profile-address">{{ $profile['address']}}</p>
                <p class="profile-address">{{ $profile['building'] }}</p>
            </div>
        </div>
    </div>
    <div class="confirm">
        <table class="payment-detail">
            <tr>
                <th class="confirm-price">商品代金</th>
                <td class="price">{{ number_format($item->price)}}</td>
            </tr>
            <tr>
                <th class="confirm-payment">支払い方法</th>
                <td class="method" id="method-info"></td>
            </tr>
        </table>
        <form action="/purchase/{{{ $item->id }}}" method="post">
            @csrf
            <input type="hidden" id="hidden-select" value="" name="payment">
            <input type="hidden" name="zipcode" value="{{ $profile['zipcode'] }}" >
            <input type="hidden" name="address" value="{{ $profile['address'] }}" >
            <input type="hidden" name="building" value="{{ $profile['building'] }}" >
            <button class="purchase-button">購入する</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection
