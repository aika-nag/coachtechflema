@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
    <form action="/mypage/profile" class="profile__form" method="post" enctype="multipart/form-data">
        @csrf
            <p class="title">プロフィール設定</p>
        <div class="icon">
                <img class="icon_image" id="avatarPreview" src="{{ asset('images/default_icon.png')}}" alt="プロフィール画像">
                <label for="avatarInput" class="upload">画像を選択する</label>
                 <input type="file" id="avatarInput" name="image" class="file_input" accept="image/*">

        </div>
        <div class="input">
                <label class="input_item" for="name">ユーザー名</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                <p class="error">{{ $errors -> first('name') }}</p>
                @enderror
        </div>
        <div class="input">
                <label class="input_item" for="zipcode">郵便番号</label>
                <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode') }}">
                @error('zipcode')
                <p class="error">{{ $errors -> first('zipcode') }}</p>
                @enderror
        </div>
        <div class="input">
                <label class="input_item" for="address">住所</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}">
                @error('address')
                <p class="error">{{ $errors -> first('address') }}</p>
                @enderror
        </div>
        <div class="input">
                <label class="input_item" for="building">建物名</label>
                <input type="text" name="building" id="building" value="{{ old('building') }}">
                @error('building')
                <p class="error">{{ $errors -> first('building') }}</p>
                @enderror
        </div>
        <button class="profile_button">更新する</button>
    </form>
  </div>
@endsection
@section('js')
<script>
    $('#avatarInput').on('change', function(ev) {

        const reader = new FileReader();

        const fileName = ev.target.files[0].name;

        reader.onload = function(ev) {
            // 読み込んだ画像データをプレビュー画像に設定
            $('#avatarPreview').attr('src', ev.target.result);
        }

        // ファイルをデータURLとして読み込む
        reader.readAsDataURL(this.file[0]);
    })
</script>
@endsection

