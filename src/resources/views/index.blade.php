@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection


@section('content')

    <div class="select__tab">
        <a href="{{ route('index')}}">おすすめ</a>
        <a href="{{ route('mylist',['keyword' =>request('keyword')]) }}">マイリスト</a>
    </div>

<div class="items__container">

@forelse($items as $item)   

    <div class="item__img--wrap">
        <a class="item__content" href="{{route('item', $item)}}">
        <img src="{{ $item->avatar_path ? Storage::url($item->avatar_path) :asset('images/default-avatar.png') }}" alt="商品画像" class="item__img">
            <p>{{ $item->name}}</p>
        </a>
    </div>
{{--
        @if($item->is_sold)
        <span class="sold">売り切れ</span>
        @else
        <span class="on-sale">販売中</span>
        @endif
--}}

@empty
    <p>出品中の商品はありません</p>
@endforelse

</div>
@endsection