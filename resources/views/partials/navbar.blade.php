<nav class="navbar navbar-expand navbar-dark  static-top" style="background-color:#B62D3A; padding-bottom:10px;">

  <a class="navbar-brand mx-0" href="{{ route('index')}}">
    <img class="img-responsive" style="height: 45px; width: 100px;" src="{{asset('images/ptc_logo_small.png')}}">
                    </a>

  <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
 
    </form>
    <!-- Navbar -->
    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
      <!-- Authentication Links -->
      @if (Auth::guest())
      <li><a href="{{ route('login') }}">Login</a></li>
      <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
      @else
      <li class="dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i> {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
          <li>
            <a class="pl-4 text-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
             <i class="fas fa-power-off"></i> Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </li>
    @endif
  </ul>


</nav>
