@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('input_bar')
<form action="/item/find" method="post">
    @csrf
    <input type="text" class="search" name="search" placeholder="なにをお探しですか？" value="{{ $input }}">
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
<form action="/sell" class="sell" method="get">
    @csrf
    <button class="sell_button">出品</button>
</form>
@endsection

@section('content')
  <div class="content">
    <form action="">
    <p class="title">商品の出品</p>
    <p class="item_image">商品画像</p>
    <p class="sell_title">商品の詳細</p>
    <p class="category">カテゴリー</p>
    <p class="item_title">商品の状態</p>
    <p class="sell_title">商品名と説明</p>
    <p class="item_title">商品名</p>
    <p class="item_title">ブランド名</p>
    <p class="item_title">商品の説明</p>
    <p class="item_title">販売価格</p>
    <button class="sell">出品する</button>
    </form>
  </div>
@endsection
