@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}">
@endsection

@section('content')
<div class="content">
  <p class="verify_email">登録していただいたメールアドレスに認証メールを送付しました。<br />メール認証を完了してください</p>
  <a href="http://localhost:8025">
    <button class="verify_button">認証はこちらから</button></a>
  <form action="/email/verification-notification" method="post">
    @csrf
    <button class="resend_button">認証メールを再送する</button>
  </form>
</div>
@endsection
