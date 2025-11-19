@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth.css')}}">
@endsection

@section('content')
<form>
<div class="auth__items">
    <h3>登録いただいたメールアドレスに認証メールを送りました</br>
    メール認証を完了してください。</h3>
<form action="{{route('auth.check')}}" method="POST">
    @csrf
    <button class="auth__button" >認証はこちらから</button>
</form>
<form action="{{route('auth.resend')}}" method="POST">
    @csrf
    <div>
        <button type="submit" class="auth__resend">認証メールを再送する</button>
    </div>
</form>
</div>
@endsection