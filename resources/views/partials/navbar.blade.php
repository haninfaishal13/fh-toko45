<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 sticky-sm-bottom sticky-md-top">
    <div class="container">
        <a class="navbar-brand" href="#">Toko45</a>
        @if (!Auth::guest())
            <ul class="flex-row navbar-nav ms-auto align-items-center">
                <li class="nav-item me-2">
                    <a class="nav-link active" href="{{route('frontsite.transaction')}}">Transaksi</a>
                </li>
            </ul>
            <div class="dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{asset('assets/image/default-user-image.jpeg')}}" class="img-circle img-icon img-fluid" alt="">
                    </div>
                    <div class="d-flex flex-column justify-content-center mx-3">
                        <a href="{{route('backsite.dashboard')}}" class="btn btn-success btn-sm mb-2">
                            Dashboard
                        </a>
                        <a href="{{route('auth.logout')}}" class="btn btn-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#auth-modal">
                <i class="fas fa-sign-in-alt me-2"></i>Login / Register
            </button>
        @endif
    </div>
</nav>
