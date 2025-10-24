<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-market</title>
    <link rel="stylesheet" href="{{asset('/css/simple.css')}}">
    @yield('css')
</head>
<body>
    <header class="header">
        <img class="header__img" src="{{ asset('images/logo.svg')}}">
    </header>  
    <main>
    @yield('content')
    </main> 
</body>
</html>