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
    <div class="logo">
      <img src="../../../../images/logo.svg" alt="coachtechロゴ" class="logo__image">
    </div>
    <div class=input_bar>
      @yield('input_bar')
    </div>
    <div class="nav">
      @yield('nav')
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
