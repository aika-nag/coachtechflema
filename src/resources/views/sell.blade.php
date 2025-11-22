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
<form action="/mypage" class="mypage">
  <button class="mypage_button">マイページ</button>
</form>
<form action="/sell" class="sell" method="get">
  @csrf
  <button class="sell_button">出品</button>
</form>
@endsection

@section('content')
<div class="content">
  <form action="/sell" method="post" enctype="multipart/form-data">
    @csrf
    <p class="title">商品の出品</p>
    <div class="image">
      <p class="item_title">商品画像</p>
      <div class="image_area">
        <img class="icon_image" id="preview" src="{{  asset('') }}" alt="商品画像">
        <label for="sell_image" class="upload">画像を選択する</label>
        <input type="file" id="sell_image" name="image" class="file_input">
      </div>
      @error('image')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>
    <div class="category">
      <p class="sell_title">商品の詳細</p>
      <p class="category_tag">カテゴリー</p>
      <div class="category_flex">
        @foreach ($categories as $category)
          <label class="tag"><input type="checkbox" class="tag_name" name="category" value="{{ $category['id'] }}">{{ $category['name']}}</label>
        @endforeach
      </div>
      @error('category')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>
    <div class="condition">
      <label class="item_title" for="item_condition">商品の状態</label>
      <select name="condition" id="item_condition" class="input_area">
        <option value="" selected hidden>選択してください</option>
        <option value="1">良好</option>
        <option value="2">目立った傷や汚れなし</option>
        <option value="3">やや傷や汚れあり</option>
        <option value="4">状態が悪い</option>
      </select>
      @error('condition')
      <p class="error">{{ $message }}</p>
      @enderror
    </div>
    <p class="sell_title">商品名と説明</p>
    <label class="item_title" for="name">商品名</label>
    <input type="text" id="name" name="name" class="input_area">
    @error('name')
    <p class="error">{{ $message }}</p>
    @enderror
    <label class="item_title" for="brand">ブランド名</label>
    <input type="text" id="brand" name="brand" class="input_area">
    <label class="item_title" for="description">商品の説明</label>
    <textarea name="description" id="description" class="description"></textarea>
    @error('description')
    <p class="error">{{ $message }}</p>
    @enderror
    <label class="item_title" for="price">販売価格</label>
    <input type="text" id="price" name="price" class="input_area">
    @error('price')
    <p class="error">{{ $message }}</p>
    @enderror
    <button class="sell_item_button">出品する</button>
  </form>
</div>
@endsection


@section('js')
<script src="{{ asset('js/sell.js') }}"></script>
@endsection

