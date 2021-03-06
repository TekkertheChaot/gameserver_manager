<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravelo') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    
    <link href="{{ asset('css/bg_anim_gradientMoving.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
    html,
    body {
        background-color: #fff;
        color: #f2f2f2;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .top-left {
        position: absolute;
        left: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
        text-shadow: 1px 1px 30px rgba(0,0,0,.7);
    }

    .links>a {
        color: #f2f2f2;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        text-shadow: 1px 1px 20px rgba(0,0,0,.4);
    }
    
    .link-buttons > a{
        padding: 10px 25px;
        border-style: solid;
        border-width: 1px;
        border-color: white;
        border-radius: .5rem;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .site-footer {
        position: fixed;
        bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right link-buttons links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                {{ config('app.name', 'LaravelBasedApp') }}
            </div>

            <div class="links">
                @if(Route::has('login'))
                @auth
                <a href="{{ url('/home') }}">Go Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
        <div class="site-footer links">
            <a href="{{ url('/about') }}">About this site</a>
            <a href="https://github.com/TekkertheChaot/gameserver_manager/">See the sauce</a>
        </div>
    </div>

</body>

</html>
