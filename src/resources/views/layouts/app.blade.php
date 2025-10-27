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
        @auth
        <img class="header__img" src="{{ asset('images/logo.svg')}}">
        <form action="">
            @csrf
            <input class="header__input" type="text" name="name" placeholder="なにをお探しですか？" >
        <nav class="links">
            <li><a href="{{ asset('/') }}" class="header__login">ログアウト</a></li>
            <li><a href="{{ asset('/mypage') }}" class="header__mypage">マイページ</a></li>
            <li><a href="{{ asset('sell') }}" class="header__sell">出品</a></li>
        </nav>
        </form>
        @endauth

        @guest
        <img class="header__img" src="{{ asset('images/logo.svg')}}">
        <form action="">
            @csrf
            <input class="header__input" type="text" name="name" placeholder="なにをお探しですか？" >
        <nav class="links">
            <li><a href="{{ asset('login')}}" class="header__login">ログイン</a></li>
            <li><a href="{{ asset('login')}}" class="header__mypage">マイページ</a></li>
            <li><a href="{{ asset('login')}}" class="header__sell">出品</a></li>
        </nav>
        </form>
        @endguest
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