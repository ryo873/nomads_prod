<header class="text-center">
    <div class="container navbar-container fixed-top">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a href="#" class="navbar-brand">
        <img src="frontend/images/logo_nomads.png" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navb" aria-controls="navb" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navigation-bg" id="navb">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-md-2">
            <a class="nav-link active" href="/">Home</a>
            </li>
            <li class="nav-item mx-md-2">
            <a class="nav-link" href="#">Paket Travel</a>
            </li>
            <li class="nav-item dropdown mx-md-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Link</a>
                <a class="dropdown-item" href="#">Link</a>
                <a class="dropdown-item" href="#">Link</a>
            </div>
            </li>
            <li class="nav-item mx-md-2">
            <a class="nav-link" href="#">Testimonial</a>
            </li>
        </ul>
        <!-- Mobile Button -->
        @if(Auth::check())
        <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}" method="post">
            @csrf
            <button class="btn btn-login my-2 my-sm-0 px-4" type="submit">Keluar</button>
        </form>

        <!-- Desktop Button -->
        <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout') }}" method="post">
            @csrf
            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">Keluar</button>
        </form>
        </div>
        @else
        <form class="form-inline d-sm-block d-md-none">
            @csrf
            <button class="btn btn-login my-2 my-sm-0 px-4" onclick="event.preventDefault(); location.href=`{{ url('login') }}`">Masuk</button>
        </form>

        <!-- Desktop Button -->
        <form class="form-inline my-2 my-lg-0 d-none d-md-block">
            @csrf
            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" onclick="event.preventDefault(); location.href=`{{ url('login') }}`">Masuk</button>
        </form>
        </div>
        @endif
    </nav>
    </div>
