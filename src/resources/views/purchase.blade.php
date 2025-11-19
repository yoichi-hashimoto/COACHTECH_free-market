@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/purchase.css')}}">
@endsection

@section('content')
<form action="{{ route('purchase.store')}}" method="POST">
    @csrf
<div class="grid">
    <div class="purchase__item">
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <img src="{{ Storage::url ($item->avatar_path) }}" alt="item_img" class="purchase__photo">
        <div class="purchase__item--detail">
        <h2>{{ $item->name}}</h2>
    <h2>¥{{ $item->price}}</h2>
        </div>
    </div>
    <div class="purchase__payment">
        <h3>支払い方法</h3>
        <div class="selectbox">
        <select class="purchase__payment--select" name="payment_method" id="selectedPaytype">
            <option value="">選択してください</option>
            <option  value="コンビニ払い">コンビニ払い</option>
            <option  value="カード支払い">カード支払い</option>
        </select>
    </div>
    @error('payment_method')
        <div>{{($message)}}</div>
    @enderror
    </div>

    <div class="address__wrap">
        <h3>配送先</h3>
        <div class="address__detail">
        <h3 name="postal_code">{{ $address->postal_code ?? '郵便番号が登録されていません' }}</h3>
        <h3 name="address">{{ $address->address ?? '住所が登録されていません' }}</h3>
        <h3 name="building">{{ $address->building ?? '建物名まで入力してください' }}</h3>
        <input type="hidden" name="address_id" value="{{$address->id ?? ''}}">
        </div>
    </div>

    <div class="address__change">
        <a href="{{ route('address.edit',['item_id'=>$item->id])}}">変更する</a>
    </div>

    <div class="paytype__grid">
        <div>商品代金</div>
        <div>¥{{ $item->price }}</div>
        <input type="hidden" name="subtotal" value="{{$item->price}}">
        <div>支払い方法</div>
        <div id="previewArea">支払い方法を選択してください</div>
    </div>
    <div class="purchase__area">
        <button type="subumit" class="purchase__button" >購入する</button>
    </div>
</form>

<script>
const paySelect = document.getElementById('selectedPaytype');
const inputArea = document.getElementById('previewArea');
paySelect.addEventListener('change',()=>{
    const value = paySelect.value.trim();
    inputArea.textContent = value;
});
</script>

@endsection
