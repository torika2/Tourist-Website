<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tourist Website</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <style type="text/css">
        body{
            background: #202225;
        }
        .text{
            background-color: white;
            color: transparent;
            text-shadow: 0px 2px 3px rgba(255,255,255,0.5);
            -webkit-background-clip: text;
            -moz-background-clip: text;
            background-clip: text;
        }
    </style>
    <div id="app" >
        <nav class="navbar navbar-expand-md shadow-sm" style="background: #40444b">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <b><code class="text" style="font-size: 19px;color:white;">Tourist Website</code></b>
                </a>
                <a class="navbar text" style="color: white;" href="/">
                    Login
                </a>
                <a class="navbar text"  style="color: white;" href="/Registration">
                    Registration
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
