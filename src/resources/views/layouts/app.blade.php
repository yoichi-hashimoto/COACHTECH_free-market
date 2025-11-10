<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-market</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>
<body>
    <header class="header">
        <a href="{{route('index')}}">
            <img class="header__img" src="{{ asset('images/logo.svg')}}">
        </a>
        <form class="header__search" action="{{ url()->current() }}" method="GET">
            @csrf
            <input class="header__input" type="text" name="keyword" value="{{ old( 'keyword')}}" placeholder="なにをお探しですか？" >
        </form>
        <nav class="links">
            <ul class="links__list">
            @auth
            <li>
        <form action="{{ route('logout')}}" method="POST">
            @csrf
                <button type="submit" class="header__logout">ログアウト</button>
        </form>
            <li><a href="{{ route('mypage') }}" class="header__mypage">マイページ</a></li>
            <li><a href="{{ route('sell') }}" class="header__sell">出品</a></li>
            @endauth
            @guest
            <li><a href="{{ route('login')}}" class="header__login">ログイン</a></li>
            <li><a href="{{ route('login')}}" class="header__mypage">マイページ</a></li>
            <li><a href="{{ route('login')}}" class="header__sell">出品</a></li>
            @endguest
        </ul>
        </nav>
</header>
    <main>
        @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
        @endif
    @yield('content')
    </main> 
</body>
</html>