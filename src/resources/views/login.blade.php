@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/login.css')}}">
@endsection

@section('content')
@if($errors->any())
    <div class="login-error">
        {{ $errors->first() }} 
    </div>
@endif
<div class="login__items">
    <form action="{{ route('login.perform')}}" method="post">
        @csrf
    <h2 class="login__title">ログイン</h2>
    <h3>メールアドレス 
        <input type="text" name="email" value="{{old('email')}}">
        @error('email')
        <p class="input__error--denger">{{ $message }}</p>
        @enderror
    </h3>
    <h3>パスワード 
        <input type="text" name="password">
        @error('password')
        <p class="input__error--denger">{{ $message }}</p>
        @enderror
    </h3>
    <button class="login__button" type="submit">ログインする</button>

<div class="register__link">
    <a href="{{asset('/register')}}">会員登録はこちら</a>
</div>
</form>
    </div>
@endsection