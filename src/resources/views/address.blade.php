@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/address.css')}}">
@endsection

@section('content')
    <form class="address__input">
    <h2 class="address__title">住所の変更</h2>
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