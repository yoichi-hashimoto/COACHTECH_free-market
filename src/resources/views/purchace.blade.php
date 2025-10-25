@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/purchace.css')}}">
@endsection

@section('content')
<div class="grid">
    <div class="purchace__product">
        <img src="images/Armani+Mens+Clock.jpg" alt="" class="purchace__photo">
        <div class="purchace__product--detail">
        <h2>商品名</h2>
    <h2>¥47,000</h2>
        </div>
    </div>
    <div class="purchace__payment">
        <h3>支払い方法</h3>
        <div class="selectbox">
        <select class="purchace__payment--select" name="" id="">
            <option value="" disable hidden>選択してください</option>
            <option value="">コンビニ払い</option>
            <option value="">カード支払い</option>
        </select>
        </div>
    </div>

    <div class="address__wrap">
        <h3>配送先</h3>
        <div class="address__detail">
        <h3>〒XXX-YYYY</h3>
        <h3>ここには住所と建物が入ります</h3>
        </div>
    </div>

    <div class="address__change">
        <a href="">変更する</a>
    </div>

    <div class="paytype__grid">
        <div>商品代金</div>
        <div>¥47,000</div>
        <div>支払い方法</div>
        <div>コンビニ払い</div>
    </div>
    <div class="purchace__area">
        <button class="purchace__button" >購入する</button>
    </div>
@endsection
