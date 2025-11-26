@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('search')
<form action="/item/find" method="post">
    @csrf
    <input type="text" class="keyword" name="search" placeholder="なにをお探しですか？" value="{{ $input }}">
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
<form action="/sell" class="sell" method="get">
    @csrf
    <button class="sell-button">出品</button>
</form>
@endsection

@section('content')
<div class="content">
    <form action="/sell" method="post" enctype="multipart/form-data">
        @csrf
        <p class="title">商品の出品</p>
        <div class="image">
            <p class="sell-title">商品画像</p>
            <div class="image-area">
                <img class="icon-image" id="preview" src="{{  asset('') }}" alt="商品画像">
                <label for="sell-image" class="upload">画像を選択する</label>
                <input type="file" id="sell-image" name="image" class="file-input">
            </div>
            @error('image')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="category">
            <p class="sub-title">商品の詳細</p>
            <p class="category-tag">カテゴリー</p>
            <div class="category-flex">
                @foreach ($categories as $category)
                <label class="tag"><input type="checkbox" class="tag-name" name="category[]" value="{{ $category['id'] }}">{{ $category['name']}}</label>
                @endforeach
            </div>
            @error('category')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="condition">
            <label class="sell-title" for="item-condition">商品の状態</label>
            <select name="condition" id="item-condition" class="input-area">
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
        <p class="sub-title">商品名と説明</p>
        <label class="sell-title" for="name">商品名</label>
        <input type="text" id="name" name="name" class="input-area">
        @error('name')
        <p class="error">{{ $message }}</p>
        @enderror
        <label class="sell-title" for="brand">ブランド名</label>
        <input type="text" id="brand" name="brand" class="input-area">
        <label class="sell-title" for="description">商品の説明</label>
        <textarea name="description" id="description" class="description"></textarea>
        @error('description')
        <p class="error">{{ $message }}</p>
        @enderror
        <label class="sell-title" for="price">販売価格</label>
        <input type="text" id="price" name="price" class="input-area" placeholder="¥">
        @error('price')
        <p class="error">{{ $message }}</p>
        @enderror
        <button class="sell-item-button">出品する</button>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('js/sell.js') }}"></script>
@endsection

