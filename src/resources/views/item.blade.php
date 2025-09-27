@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/item.css') }}">
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
<form action="" class="sell">
    <button class="sell_button">出品</button>
</form>
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
        </form>

        <img src="../../../images/comment.png" alt="">
      </div>
      <form action="">
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
    </div>
  </div>
@endsection
