<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Coachtech</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header_inner">
        <a href="/" class="logo">
            <img src="../../../../images/logo.svg" alt="coachtechロゴ" class="logo_image">
        </a>
        <button class="toggle-menu-button" id="toggle-menu-button"></button>
        <div class="header-site-menu" id="header-site-menu">
            <div class=input_bar>
            @yield('input_bar')
            </div>
            <div class="nav">
            @yield('nav')
            </div>
        </div>
    </div>
  </header>

  <main>
  @yield('content')
  </main>
  @yield('js')
  <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
