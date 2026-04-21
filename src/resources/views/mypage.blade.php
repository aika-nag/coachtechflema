@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
<form action="/sell" class="sell">
    <button class="sell-button">出品</button>
</form>
@endsection

@section('content')
<div class="user-profile">
    @if(isset($profile))
    @if($profile['image'] != null)
    <img src="{{ asset('storage/images/'.$profile['image']) }}" alt="アイコン画像" class="icon" id="icon">
    @else
    <img src="{{ asset('images/default_icon.png') }}" alt="アイコン画像を登録できます" class="icon">
    @endif
    <p class="name">{{ $profile['name'] }}</p>
    @else
    <img src="{{ asset('images/default_icon.png') }}" alt="アイコン画像を登録できます" class="icon">
    <p class="set-up-profile">右のボタンを押して<br />プロフィールを設定してください</p>
    @endif
    <form action="/mypage/profile" class="edit-form">
        <button class="edit-profile">プロフィールを編集</button>
    </form>
</div>
<div class="link">
    <a href="/mypage?page=sell" class="sell-item" id="sell-item">出品した商品</a>
    <a href="/mypage?page=buy" class="buy-item" id="buy-item">購入した商品</a>
</div>
<div class="items">
    @if(isset($items))
    @foreach ($items as $item)
    <div class="item">
        @if($item->order != null )
        <div class="item-classify">
            <span class="sold">Sold</span>
        </div>
        @endif
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
