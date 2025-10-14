@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('input_bar')
<form action="/item/find" method="post">
  @csrf
  <input type="text" class="search" name="search" placeholder="なにをお探しですか？" value="{{ $input }}">
</form>
@endsection

@section('nav')
@if(Auth::check())
<form action="/logout" class="logout" method="post">
  @csrf
  <button class="logout_button">ログアウト</button>
</form>
<form action="/mypage" class="mypage">
  <button class="mypage_button">マイページ</button>
</form>
<form action="/sell" class="sell" method="get">
  <button class="sell_button">出品</button>
</form>
@else
<form action="/login" class="logout" method="get">
  <button class="logout_button">ログイン</button>
</form>
<form action="/login" class="mypage" method="get">
  <button class="mypage_button">マイページ</button>
</form>
<form action="/login" class="sell" method="get">
  <button class="sell_button">出品</button>
</form>
@endif
@endsection

@section('content')
<div class="content">
  <div class="title">
    <a href="/" class="recommend_link"><p class="@if(Auth::check()) login_recommend @else recommend @endif">おすすめ</p></a>
    <form action="/?tab=mylist" method="post">
      @csrf
      <button class="@if(Auth::check()) login_mylist @else mylist @endif">マイリスト</button>
    </form>
  </div>
  <div class="items">
    @if($items != null)
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
</div>
@endsection


