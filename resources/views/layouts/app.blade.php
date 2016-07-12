<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SAPEIM</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <link rel="stylesheet" href="{{ elixir('css/app.scss') }}" media="screen" title="no title" charset="utf-8">

</head>
<body id="app-layout">
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
          SAPEIM
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->

        <ul class="nav navbar-nav">

          @if(Auth::guest())
            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/issues') }}">Support</a></li>
          @endif

          @if(Auth::check())

            <li><a href="{{ url('/products') }}">Products</a></li>
            <li><a href="{{ url('/maintenances') }}">Maintenances</a></li>
            <li><a href="{{ url('/orders') }}">Orders</a></li>
            <li><a href="{{ url('/sales') }}">Sales</a></li>

            @if(Auth::user()->rol_id > 1)
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  Team<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('/sellers') }}">Sellers</a></li>
                  <li><a href="{{ url('/resellers') }}">Resellers</a></li>
                </ul>
              </li>

              @if(Auth::user()->rol_id == 3)
                <li><a href="{{ url('/users') }}">Users</a></li>
                <li><a href="{{ url('/logs') }}">Log</a></li>
              @endif

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  Database<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">

                  <li><a href="{{ url('/manufacturers') }}">Manufacturers</a></li>
                  <li><a href="{{ url('/categories') }}">Categories</a></li>
                  <li><a href="{{ url('/states') }}">States</a></li>
                  <li><a href="{{ url('/stores') }}">Stores</a></li>
                  <li><a href="{{ url('/cities') }}">Cities</a></li>
                </ul>
              </li>
            @endif

            <li><a href="{{ url('/issues') }}">Support</a></li>
          @endif


        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->username }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('users.edit', Auth::user()->id) }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>

  <!-- JavaScripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
