@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection


@section('content')

    <div class="select__tab">
        <a href="{{ route('index')}}" class="tab__label {{ $tab === 'recommend' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('mylist',['keyword' =>request('keyword')]) }}" class="tab__label {{ $tab === 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>

<div class="items__container">
@forelse($items as $item)   

    <div class="item__img--wrap">
        @if($item->purchases_count > 0)
        <img src="{{ $item->avatar_path ? Storage::url($item->avatar_path) :asset('images/default-avatar.png') }}" alt="商品画像" class="item__img">
        <div class="item__detail">
            <p>{{ $item->name}}</p>
            <p>￥{{ $item->price}}</p>
        </div>
        <span class="sold">SOLD</span>
        @else
        <a class="item__content" href="{{route('item', $item)}}">
        <img src="{{ $item->avatar_path ? Storage::url($item->avatar_path) :asset('images/default-avatar.png') }}" alt="商品画像" class="item__img">
        <div class="item__detail">
            <p>{{ $item->name}}</p>
            <p>￥{{ $item->price}}</p>
        </div>
            @endif
        </a>
    </div>

@empty
    <p>マイリストの商品はありません</p>
@endforelse

</div>
@endsection