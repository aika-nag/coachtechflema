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
<form action="/logout" class="logout" method="post">
    @csrf
    <button class="logout_button">ログアウト</button>
</form>
<form action="" class="mypage">
    <button class="mypage_button">マイページ</button>
</form>
<form action="/sell" class="sell" method="get">
    <button class="sell_button">出品</button>
</form>
@endsection

@section('content')
  <div class="content">
    <div class="title">
        <p class='recommend'>おすすめ</p>
        <form action="/?tab=mylist" method="post">
          @csrf
          <button class="mylist">マイリスト</button>
        </form>
    </div>
    <div class="items">
        @foreach ($items as $item)
        <div class="item_img">
            <a href="/item/{{ $item ->id }}"><img src="{{ asset('images' . $item -> image) }}" alt="{{ $item -> name }}" class="image"></a>
            <p class="item_name">{{ $item -> name }}</p>
        </div>
        @endforeach
    </div>
  </div>
@endsection
