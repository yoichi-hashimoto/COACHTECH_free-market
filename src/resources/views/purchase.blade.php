@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/purchase.css')}}">
@endsection

@section('content')
<div class="grid">
    <div class="purchase__item">
        <img src="images/Armani+Mens+Clock.jpg" alt="" class="purchase__photo">
        <div class="purchase__item--detail">
        <h2>商品名</h2>
    <h2>¥47,000</h2>
        </div>
    </div>
    <div class="purchase__payment">
        <h3>支払い方法</h3>
        <div class="selectbox">
        <select class="purchase__payment--select" name="" id="">
            <option value="" disable hidden>選択してください</option>
            <option value="">コンビニ払い</option>
            <option value="">カード支払い</option>
        </select>
        </div>
    </div>

    <div class="address__wrap">
        <h3>配送先</h3>
        <div class="address__detail">
        <h3>{{ $address->postal_code }}</h3>
        <h3>{{ $address->address }}</h3>
        <h3>{{ $address->building }}</h3>
        </div>
    </div>

    <div class="address__change">
        <a href="{{('/address')}}">変更する</a>
    </div>

    <div class="paytype__grid">
        <div>商品代金</div>
        <div>¥47,000</div>
        <div>支払い方法</div>
        <div>コンビニ払い</div>
    </div>
    <div class="purchase__area">
        <button class="purchase__button" >購入する</button>
    </div>
@endsection
