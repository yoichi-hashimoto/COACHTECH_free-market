@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/address.css')}}">
@endsection

@section('content')
<form class="address__input" method="POST" action="{{ route('address.update') }}">
    @csrf
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h2 class="address__title">住所の変更</h2>
    <h3>郵便番号 
        <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}">
    </h3>
    <h3>住所
        <input type="text" name="address" value="{{ old('address', $address->address ?? '') }}">
    </h3>
    <h3>建物名
        <input type="text" name="building" value="{{ old('building', $address->building ?? '') }}">
    </h3>
    <input type="hidden" name="return_item_id" value="{{ $itemId }}">
    <button type="submit" class="update__button" >更新する</button>
</form>
@endsection