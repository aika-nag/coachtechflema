@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
<div class="content">
    <form action="/mypage/profile" class="profile-form" method="post" enctype="multipart/form-data">
        @csrf
        <p class="title">プロフィール設定</p>
        <div class="icon">
            @if(isset($profile))
            @if($profile->image != null)
            <img src="{{ asset('storage/images/'.$profile['image']) }}" alt="アイコン画像" class="icon-image" id="preview">
            @else
            <img src="{{ asset('images/default_icon.png')}}" alt="" class="icon-image" id="preview">
            @endif
            @else
            <img class="icon-image" id="preview" src="{{ asset('images/default_icon.png')}}" alt="プロフィール画像">
            @endif
            <label for="avatarInput" class="upload">画像を選択する</label>
            <input type="file" id="avatarInput" name="image" class="file-input">
            @error('image')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="profile">
            <label class="input-item" for="name">ユーザー名</label>
            @if(isset($profile))
            <input type="text" name="name" id="name" class="input" value="{{ $profile->name }}">
            @else
            <input type="text" name="name" id="name" class="input" value="{{ old('name') }}">
            @endif
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="profile">
            <label class="input-item" for="zipcode">郵便番号</label>
            @if(isset($profile))
            <input type="text" name="zipcode" id="zipcode" class="input" value="{{ $profile->zipcode }}">
            @else
            <input type="text" name="zipcode" id="zipcode" class="input" value="{{ old('zipcode') }}">
            @endif
            @error('zipcode')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="profile">
            <label class="input-item" for="address">住所</label>
            @if(isset($profile))
            <input type="text" name="address" id="address" class="input" value="{{ $profile->address }}">
            @else
            <input type="text" name="address" id="address" class="input" value="{{ old('address') }}">
            @endif
            @error('address')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="profile">
            <label class="input-item" for="building">建物名</label>
            @if(isset($profile))
            <input type="text" name="building" id="building" class="input" value="{{ $profile->building }}">
            @else
            <input type="text" name="building" id="building" class="input" value="{{ old('building') }}">
            @endif
            @error('building')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button class="update-button">更新する</button>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('js/profile.js') }}"></script>
@endsection

