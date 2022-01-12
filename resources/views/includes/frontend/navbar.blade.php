<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <!-- <a class="navbar-brand" href="{{url('/')}}">
          <img src="/montir/asset/elements/logo_small.png" alt="hefa store">
        </a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto text-uppercase">
            <!-- <li class="home nav-item {{ (request()->is('/')) ? 'active' : '' }} ">
              <a class="nav-link" href="{{url('/')}}">Montir</a>
            </li>
            <li class="home nav-item {{ (request()->is('kategori-montir')) ? 'active' : '' }} ">
              <a class="nav-link" href="{{route('kategori')}}">Kategori Montir</a>
            </li>
            <li class="nav-item">
              <a class="home nav-link" href="#">Tentang Kami</a>
            </li> -->
          </ul>
          @auth
            <a href="{{route('home')}}" class=" text-white">Dashboard</a> &nbsp; <span class="text-white">|</span> &nbsp;

            <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class=" text-white">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          @else
            <a  href="{{url('login')}}" class="btn mx-4 text-white" style="background-color: #f9b234;">Sign in</a>

            <a href="{{url('register')}}" class="btn mx-4 text-dark" style="background-color: #f6f7fb;">Sign up</a>
          @endauth
        </div>
      </div>
    </nav>

