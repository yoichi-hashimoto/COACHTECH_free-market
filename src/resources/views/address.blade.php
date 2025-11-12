@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/address.css')}}">
@endsection

@section('content')
<form class="address__input" method="POST" action="{{route('address.update')}}">
    @csrf
    <input type="hidden" name="return_item_id" value="{{ $itemId }}">
    <h2 class="address__title">住所の変更</h2>
    <h3>郵便番号 
        <input name="postal_code" type="text" value="{{ $address->postal_code ?? '000-0000'}}">
    @error('postal_code')<div class="error">{{ $message }}</div>@enderror
    </h3>
    <h3>住所
        <input name="address" type="text" value="{{ $address->address ?? '住所登録がありません'}}">
    @error('address')<div class="error">{{ $message }}</div>@enderror
    </h3>
    <h3>建物名
        <input name="building" type="text" value="{{ $address->building ?? '-'}}">
    </h3>
    <button type="submit" class="update__button" >更新する</button>
</form>
@endsection