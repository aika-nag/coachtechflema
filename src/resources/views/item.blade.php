@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('search')
<form action="/item/find" method="post">
    @csrf
    <input type="text" class="keyword" name="search" placeholder="なにをお探しですか？" value="{{ old('search') }}">
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
<form action="/sell" class="sell">
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
<div class="content">
    <div class="item-image">
        @if($item->order != null )
        <div class="item-classify">
            <span class="sold">Sold</span>
        </div>
        @endif
        <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}" class="image">
    </div>
    <div class="detail">
        <p class="item-name">{{ $item->name }}</p>
        <p class="item-brand">{{ $item->brand }}</p>
        <p class="item-price">{{ number_format($item->price)}}</p>
        <div class="function">
            <form action="/item/{{ $item->id }}/favorite" class="favorite" method="post">
                @csrf
                @if(Auth::check())
                @if ($item->favorites()->where('user_id', Auth::user()->id)->count() == 1)
                <div class="function-favorite">
                    <button type="submit" class="favorite-star">
                    <img src="../../../images/favorite.png" alt="いいね" class="star-image"></button>
                    <span class="count">{{ $item->favorites->count() }}</span>
                </div>
                @else
                <div class="function-favorite">
                    <button type="submit" class="unfavorite-star"><img src="../../../images/favorite.png" alt="いいね取り消し" class="star-image"></button>
                    <span class="uncount">{{ $item->favorites->count() }}</span>
                </div>
                @endif
                @else
                <div class="function-favorite">
                    <img src="../../../images/favorite.png" alt="いいね" class="favorite-star">
                    <span class="uncount">{{ $item->favorites->count() }}</span>
                </div>
                @endif
            </form>
            <div class="function-comment">
                <img src="../../../images/comment.png" alt="" class="comment-image">
                <span class="count-comment">{{ $item->comments->count() }}</span>
            </div>
        </div>
        <form action="/purchase/{{{$item->id}}}" method="get">
            @if($item->order != null)
            <button class="restrict-purchase" disabled>購入手続きへ</button>
            @else
            <button class="purchase-button">購入手続きへ</button>
            @endif
        </form>
        <p class="title">商品説明</p>
        <p class="description">{{ $item->description }}</p>
        <p class="title">商品の情報</p>
        <table class="item-information">
            <tr>
                <th class="information">カテゴリー</th>
                <td class="category">
                    <div class="category-flex">
                    @foreach ($item->categories as $category)
                    <p class="category-tag">{{ $category['name'] }}</p>
                    @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <th class="information">商品の状態</th>
                <td class="condition">
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
            <div class="comment-title">
                <p class="comment">コメント(<span>{{ $item->comments->count() }}</span>)
                </p>
            </div>
            @foreach ($comments as $comment)
            <div class="user-comment">
                <div class="icon-name">
                    @if($comment['user']['profile']['image'] != null)
                    <img src="{{ asset('storage/images/'.$comment['user']['profile']['image']) }}" alt="アイコン画像" class="user-icon" id="preview">
                    @else
                    <img src="{{ asset('images/default_icon.png')}}" alt="" class="user-icon">
                    @endif
                    <span class="user-name">{{ $comment['user']['profile']['name'] }}</span>
                </div>
                <p class="comment-detail">{{ $comment['content'] }}</p>
            </div>
            @endforeach
            <p class="item-comment">商品へのコメント</p>
            <textarea name="content" class="comment-content"></textarea>
            @error('content')
            <p class="error">{{ $message }}</p>
            @enderror
            @if($item->order != null)
            <button class="restrict-comment" disabled>コメントを送信する</button>
            @else
            <button class="comment-button">コメントを送信する</button>
            @endif
        </form>
    </div>
</div>
@endsection
