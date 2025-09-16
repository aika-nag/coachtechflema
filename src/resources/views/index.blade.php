@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('input_bar')
<input type="text" class="search" placeholder="なにをお探しですか？">
@endsection

@section('nav')
<button class="logout">ログアウト</button>
<button class="mypage">マイページ</button>
<button class="sell">出品</button>
@endsection

@section('content')
  <div class="content">
    <div class="title">
        <p class='recommend'>おすすめ</p>
        <p class="mylist">マイリスト</p>
    </div>
    <div class="items">
        @foreach ($items as $item)
        <div class="item_img">
            <img src="{{ asset('images' . $item -> image) }}" alt="商品画像" class="image">
            <p class="item_name">{{ $item -> name }}</p>
        </div>
        @endforeach
    </div>
  </div>
@endsection
