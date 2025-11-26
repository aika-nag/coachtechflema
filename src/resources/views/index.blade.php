@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('search')
<form action="/item/find" method="post" class="search-form">
    @csrf
    <input type="text" class="keyword" name="search" placeholder="なにをお探しですか？" value="{{ $input }}">
</form>
@endsection

@section('nav')
@if(Auth::check())
<form action="/logout" class="logout" method="post">
    @csrf
    <button class="logout-button">ログアウト</button>
</form>
<form action="/mypage" class="mypage">
    <button class="mypage-button">マイページ</button>
</form>
<form action="/sell" class="sell" method="get">
    <button class="sell-button">出品</button>
</form>
@else
<form action="/login" class="logout" method="get">
    <button class="logout-button">ログイン</button>
</form>
<form action="/login" class="mypage" method="get">
    <button class="mypage-button">マイページ</button>
</form>
<form action="/login" class="sell" method="get">
    <button class="sell-button">出品</button>
</form>
@endif
@endsection

@section('content')
@if (session('message'))
    <div class="alert">
        {{ session('message') }}
    </div>
@endif
<div class="link">
    <a href="/" class="recommend-link"><p class="@if(Auth::check()) login-recommend @else guest-recommend @endif">おすすめ</p></a>
    <form action="/?tab=mylist" method="post">
        @csrf
        <button class="@if(Auth::check()) login-mylist @else guest-mylist @endif">マイリスト</button>
    </form>
</div>
<div class="items">
    @if($items != null)
    @foreach ($items as $item)
    <div class="item">
        @if($item->order != null )
        <div class="item-classify">
            <span class="sold">Sold</span>
        </div>
        @endif
        <a href="/item/{{{ $item ->id }}}">
            <img src="{{ asset('storage/images/' . $item -> image) }}" alt="{{ $item -> name }}" class="image">
        </a>
        <p class="item-name">{{ $item -> name }}</p>
    </div>
    @endforeach
    @else
    <div></div>
    @endif
</div>
@endsection
