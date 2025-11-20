@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/profile.css')}}">
@endsection

@section('content')
    <form class="profile__input">
    <h2 class="profile__title">プロフィール設定</h2>
<div class="profile__items">
    <img src="{{ $user->avatar_path ? Storage::url($user->avatar_path) : asset('images/default-avatar.png') }}">
    <button href="" class="imgedit__button">画像を選択する</button>
</div>
    <h3>ユーザー名 
        <input type="text">
    </h3>
    <h3>郵便番号 
        <input type="text">
    </h3>
    <h3>住所
        <input type="text">
    </h3>
    <h3>建物名
        <input type="text">
    </h3>
    <button class="update__button" >更新する</button>
</form>
@endsection