@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/registry.css')}}">
@endsection

@section('content')
<div class="entry__items">
    <form>
    <h2 class="entry__title">会員登録</h2>
    <h3>ユーザー名 
        <input type="text">
    </h3>
    <h3>メールアドレス 
        <input type="text">
    </h3>
    <h3>パスワード 
        <input type="text">
    </h3>
    <h3>確認用パスワード
        <input type="text">
    </h3>

    <button class="registry__button" >登録する</button>

<div class="login__link">
    <a href="{{asset('/login')}}">ログインはこちら</a>
</div>
</form>
    </div>
@endsection