@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}">
@endsection

@section('content')
<div class="content">
    <p class="verify-email">登録していただいたメールアドレスに認証メールを送付しました。<br />メール認証を完了してください</p>
    <a href="http://localhost:8025">
    <button class="verify-button">認証はこちらから</button></a>
    <form action="/email/verification-notification" method="post">
        @csrf
        <button class="resend-button">認証メールを再送する</button>
    </form>
</div>
@endsection
