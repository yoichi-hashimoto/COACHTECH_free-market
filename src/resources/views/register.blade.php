@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/register.css')}}">
@endsection

@section('content')
<div class="entry__items">
    <form action="/register" method="post">
        @csrf
    <h2 class="entry__title">会員登録</h2>
    <h3>ユーザー名 
        <input type="text" name="name" value={{ old('name')}}>
    </h3>
        @error('name')
        <p>{{ $message }}</p>
        @enderror
    <h3>メールアドレス 
        <input type="text" name="email" value={{ old('email')}}>
        @error('email')
        <p>{{ $message }}</p>
        @enderror
    </h3>
    <h3>パスワード 
        <input type="text" name="password" />
    </h3>
        @error('password')
        <p>{{ $message }}</p>
        @enderror
    <h3>確認用パスワード
        <input type="text" name="password_confirmation">
    </h3>

    <button class="register__button" >登録する</button>

<div class="login__link">
    <a href="{{asset('/login')}}">ログインはこちら</a>
</div>
</form>
    </div>
@endsection