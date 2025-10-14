@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
<form action="/sell" class="sell">
    <button class="sell_button">出品</button>
</form>
@endsection

@section('content')
<div class="user_profile">
  @if($profile['image'] != null)
  <img src="{{ asset('storage/images/'.$profile['image']) }}" alt="アイコン画像" class="icon">
  @else
  <img src="{{ asset('images/default_icon.png') }}" alt="アイコン画像を登録できます" class="icon">
  @endif
  <p class="name">{{ $profile['name'] }}</p>
  <form action="/mypage/profile">
    <button class="edit_profile">プロフィールを編集</button>
  </form>
</div>
<div class="title">
  <form action="/mypage?page=sell" class="sell_link" method="post">
    @csrf
    <button class="sell_item" id="sell_item">出品した商品</button>
  </form>
  <form action="/mypage?page=buy" class="buy_link" method="post">
    @csrf
    <button class="buy_item" id="buy_item">購入した商品</button>
  </form>
</div>
<div class="items">
    @if(isset($items))
      @foreach ($items as $item)
       <div class="item_img">
       <a href="/item/{{{ $item ->id }}}"><img src="{{ asset('storage/images/' . $item -> image) }}" alt="{{ $item -> name }}" class="image"></a>
       <p class="item_name">{{ $item -> name }}</p>
       </div>
       @endforeach
    @else
    <div></div>
    @endif
</div>
@endsection

@section('js')
<script src="{{ asset('js/mypage.js') }}"></script>
@endsection
