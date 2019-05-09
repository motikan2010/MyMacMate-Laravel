<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'MyMacMate') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/original.css">
  <link rel="stylesheet" href="/css/create.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  @yield('sticker_css')

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
  </script>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">{{ config('app.name', 'MyMacMate') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div  id="collapse" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="/design/">Designs</a></li>
          @if ( !Auth::guest() )
            <li class="nav-item"><a class="nav-link" href="/design/create">Create</a></li>
          @endif
          @yield('create_navbar')
        </ul>

        <ul class="navbar-nav">
          <!-- Authentication Links -->
          @if ( Auth::guest() )
            {{-- Guest state  --}}
            <li class="nav-item"><a class="nav-link" href="/login">Sign in</a></li>
            <li class="nav-item"><a class="nav-link btn btn-primary" href="/register">Sign up</a></li>
          @else
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/sticker">My Sticker</a>
              <a class="dropdown-item" href="/design/my">My Designs</a>
              <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action="/logout" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
          @endif
        </ul>

      </div>
    </div>
  </nav>
</header>
<div style="height:70px;"></div>

@yield('content')

<footer class="footer">
  <center><p class="text-muted"><a href="https://twitter.com/motikan2010" target="_blank">@motikan2010</a> 2014-</p></center>
</footer>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
@yield('javascript')
</body>
</html>
