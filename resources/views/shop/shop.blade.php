<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AcisaPanaderias</title>
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/icon?family=Material+Icons'>
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel='stylesheet'
          href='https://fonts.googleapis.com/css?family=Roboto:300'>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet"
          href="/css/orders.css">
</head>

<body>
    <header>
        <div class="header-inner clearfix">
            <div class="nav-btn nav-slider">
                <i class="material-icons">menu</i>
            </div>
            @include('shop.partials.search')
            @include('shop.partials.headerMenu')
        </div>
    </header>

    <div class="container">
        @include('shop.partials.sidebar')

        <main role="main">
            @yield('content')
        </main>
    </div>
    @routes
    <script src='/js/app.js'></script>
    <script src="/js/tienda.js"></script>
</body>

</html>