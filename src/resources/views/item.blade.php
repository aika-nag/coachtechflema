@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('input_bar')
<form action="/item/find" method="post">
  @csrf
  <input type="text" class="search" name="search" placeholder="なにをお探しですか？" value="{{ old('search') }}">
</form>
@endsection

@section('nav')
@if(Auth::check())
<form action="/logout" class="logout" method="post">
  @csrf
  <button class="logout_button">ログアウト</button>
</form>
<form action="" class="mypage">
  <button class="mypage_button">マイページ</button>
</form>
<form action="" class="sell">
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
  <div class="item_image">
    <img src="{{ asset('images' . $item->image) }}" alt="{{ $item->name }}" class="image">
  </div>
  <div class="detail">
    <p class="item_name">{{ $item->name }}</p>
    <p class="item_brand">{{ $item->brand }}</p>
    <p class="item_price">{{ number_format($item->price)}}</p>
    <div class="function">
      <form action="/item/{{ $item->id }}/favorite" class="favorite" method="post">
        @csrf
        @if(Auth::check())
          @if ($item->favorites()->where('user_id', Auth::user()->id)->count() == 1)
          <div class="function_favorite">
            <button type="submit" class="favorite_star">
            <img src="../../../images/favorite.png" alt="いいね" class="star_image"></button>
             <span class="count">{{ $item->favorites->count() }}</span>
          </div>
          @else
          <div class="function_favorite">
            <button type="submit" class="unfavorite_star"><img src="../../../images/favorite.png" alt="いいね取り消し" class="star_image"></button>
            <span class="uncount">{{ $item->favorites->count() }}</span>
           </div>
          @endif
        @else
        <div class="function_favorite">
          <img src="../../../images/favorite.png" alt="いいね" class="favorite_star">
          <span class="uncount">{{ $item->favorites->count() }}</span>
        </div>
        @endif
      </form>
      <div class="function_comment">
        <img src="../../../images/comment.png" alt="" class="comment_image">
        <span class="count_comment">{{ $item->comments->count() }}</span>
      </div>
    </div>
    <form action="/purchase/{{{$item->id}}}" method="get">
      <button class="to_purchase">購入手続きへ</button>
    </form>
    <p class="item_description">商品説明</p>
    <p class="text">{{ $item->description }}</p>
    <p class="item_description">商品の情報</p>
    <table class="item_info">
      <tr>
        <th class="info">カテゴリー</th>
        <td class="info_category">
        <div class="category_flex">
          @foreach ($item->categories as $category)
            <p class="category_tag">{{ $category['name'] }}</p>
          @endforeach
        </div>
        </td>
      </tr>
      <tr>
        <th class="info">商品の状態</th>
        <td class="info_condition">
          @if($item['condition'] == 1 )
          良好
          @elseif($item['condition'] == 2 )
          目立った傷や汚れなし
          @elseif($item['condition'] == 3 )
          やや傷や汚れあり
          @else
          状態が悪い
          @endif
        </td>
      </tr>
    </table>
    <form action="/item/{{{$item->id}}}/comments" method="post">
      @csrf
      <div class="comment_title">
        <p class="comment">コメント(<span>{{ $item->comments->count() }}</span>)
        </p>
      </div>
      @foreach ($comments as $comment)
      <div class="user_comment">
        <div class="icon_name">
          <img src="{{ asset('images/default_icon.png')}}" alt="" class="user_icon">
          <span class="user_name">{{ $comment['user']['profile']['name'] }}</span>
        </div>
        <p class="comment_detail">{{ $comment['content'] }}</p>
      </div>
      @endforeach
        <p class="item_comment">商品へのコメント</p>
        <textarea name="content" class="comment_content"></textarea>
        <button class="comment_button">コメントを送信する</button>
    </form>
  </div>
</div>
@endsection
