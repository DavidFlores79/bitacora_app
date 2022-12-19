<!-- Top navbar -->
<nav class="navbar navbar-dark navbar-expand-lg" id="navbar-main">
    <div class="container-fluid d-flex justify-content-between mx-md-4 mx-lg-3">

        <nav aria-label="breadcrumb" class="d-none d-md-inline-block mt-3">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
            </ol>
        </nav>

        <ul class="nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('assets') }}/img/brand/user.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header">
                        <h6 class="text-overflow">¡Bienvenido!</h6>
                        <div class="mb-1 text-sm">{{ auth()->user()->miPerfil->nombre }}</div>
                        @if(auth()->user()->perfil_id != 1)
                            <div class="mb-1 text-sm">{{ auth()->user()->servicios[0]['nombre'] }}</div>
                        @endif
                        <div class="mb-0 text-sm text-dark font-weight-bold">{{ auth()->user()->name }}</div>
                        <!-- <div class="mb-0 text-sm text-dark font-weight-bold"></div> -->
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Salir</span>
                    </a>
                </div>

            </li>
        </ul>
    </div>
</nav>
